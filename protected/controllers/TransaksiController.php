<?php

class TransaksiController extends Controller
{
    public $layout = 'column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create', 'scan', 'updateQty', 'paymentRequest', 'changeRequest', 'deleteItem', 'cancelTransaction'),
                'expression' => 'UserAccess::ruleAccess(\'create_p\')',
            ),
            array('allow',
                'actions' => array('viewItems', 'print', 'promocode'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('view'),
                'expression' => 'UserAccess::ruleAccess(\'read_p\')',
            ),
            array('allow',
                'actions' => array('update', 'change', 'createDiscount', 'setCurrency', 'paymentRequestUpdate'),
                'expression' => 'UserAccess::ruleAccess(\'update_p\')',
            ),
            array('allow',
                'actions' => array('delete'),
                'expression' => 'UserAccess::ruleAccess(\'delete_p\')',
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionCreate()
    {
        //Yii::app()->user->setState('items_data', Produk::getArrayData());
        if (!Yii::app()->user->hasState('items_belanja'))
            Yii::app()->user->setState('promocode', null);
        else {
            if (count(Yii::app()->user->getState('items_belanja')) == 0)
                Yii::app()->user->setState('promocode', null);
        }
        if (Yii::app()->user->hasState('promocode'))
            $promocode = Promosi::model()->findByPk(Yii::app()->user->getState('promocode'))->kode_promosi;

        $this->render('create', array(
            'model' => $model,
            'promocode' => $promocode,
        ));
    }

    public function actionScan()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (!empty($_POST['item'])) {
                $pecah = explode(" - ", $_POST['item']);
                $criteria = new CDbCriteria;
                $criteria->compare('id', $pecah[0]);
                $count = Produk::model()->count($criteria);
                if ($count > 0) {
                    $model = Produk::model()->find($criteria);
                    if (!Yii::app()->user->hasState('items_belanja'))
                        Yii::app()->user->setState('items_belanja', array());

                    $items = array(
                        'id' => $model->id,
                        'name' => $model->nama_produk,
                        'desc' => $model->deskripsi_produk,
                        'unit_price' => $model->harga_produk,
                        'qty' => 1,
                        'discount' => 0,
                        'change_value' => 1,
                    );

                    $items_belanja = Yii::app()->user->getState('items_belanja');
                    $new_items_belanja = array();
                    if (count($items_belanja) > 0) {
                        $any = 0;
                        foreach ($items_belanja as $index => $data) {
                            if ($data['id'] == $items['id']) {
                                $data['qty'] = $data['qty'] + 1;
                                $any = $any + 1;
                            }
                            $new_items_belanja[] = $data;
                        }
                        if ($any <= 0)
                            array_push($new_items_belanja, $items);
                    } else {
                        array_push($new_items_belanja, $items);
                    }
                    //renew state
                    Yii::app()->user->setState('items_belanja', $new_items_belanja);

                    echo CJSON::encode(array(
                        'status' => 'success',
                        'div' => $this->renderPartial('_items', array('model' => $model), true, true),
                        'subtotal' => number_format($this->getTotalBelanja(), 0, ',', '.'),
                    ));
                } else {
                    echo CJSON::encode(array(
                        'status' => 'failed',
                        'message' => $model->name . ' is out of stock.',
                    ));
                }
                exit;
            }
        }
    }

    public function actionUpdateQty()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (Yii::app()->user->hasState('items_belanja')) {
                $items_belanja = Yii::app()->user->getState('items_belanja');
                $id = $_POST['id'];
                $cart_discount = $items_belanja[$id]['discount'] / $items_belanja[$id]['qty'];
                $items_belanja[$id]['qty'] = (int)$_POST['qty'];
                $model = Produk::model()->findByPk($items_belanja[$id]['id']);
                $price = 0;
                    if ($model->diskon_rel_count > 0) {
                        foreach ($model->getDiscontedItems() as $index => $data) {
                            if ($data->jumlah_produk <= 0)
                                $data->jumlah_produk = 1;
                            $bagi = $items_belanja[$id]['qty'] / $data->jumlah_produk;
                            $mod = $items_belanja[$id]['qty'] % $data->jumlah_produk;
                            if (((int)$bagi > 0) & ($bagi <= $data->jumlah_produk)) {
                                if (time() >= strtotime($data->tanggal_mulai_diskon) && time() <= strtotime($data->tanggal_berakhir_diskon)) {
                                    $price = (int)$bagi * $data->harga_produk;
                                    if ($mod > 0)
                                        $price = $price + $items_belanja[$id]['unit_price'] * $mod;
                                    $items_belanja[$id]['discount'] = ($items_belanja[$id]['unit_price'] * $items_belanja[$id]['qty']) - $price;
                                }
                            }
                        }
                    } else {
                        $price = $model->harga_produk * $_POST['qty'];
                        if (Yii::app()->user->hasState('promocode'))
                            $items_belanja[$id]['discount'] = Promosi::getDiscountValue(Yii::app()->user->getState('promocode'), $price);
                    }
                    Yii::app()->user->setState('items_belanja', $items_belanja);
                    if ($price > 0)
                        $total = $price;
                    else
                        $total = $items_belanja[$id]['unit_price'] * $items_belanja[$id]['qty'];
                    //$discount=($model->price->sold_price*$_POST['qty'])-$total;
                    $discount = $items_belanja[$id]['discount'];

                    echo CJSON::encode(array(
                        'status' => 'success',
                        'div' => (int)$_POST['qty'],
                        'total' => number_format($total - $discount, 0, ',', '.'),
                        'subtotal' => number_format($this->getTotalBelanja(), 0, ',', '.'),
                        'discount' => number_format($discount, 0, ',', '.'),
                    ));
                exit;
            }
        }
    }

    public function actionPaymentRequest()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            //Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            //Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

            $model = new PaymentForm;
            if (isset($_POST['PaymentForm'])) {
                if (Yii::app()->user->hasState('items_belanja')) {
                    $model2 = new Tagihan;
                    if (Yii::app()->user->hasState('customer')) {
                        $customer = Yii::app()->user->getState('customer');
                        $model2->id_pelanggan = (!empty($customer)) ? $customer->id : 0;
                    }
                    $model2->status_tagihan = Tagihan::STATUS_PAID;
                    $model2->total_tagihan = $this->money_unformat($_POST['PaymentForm']['amount_tendered']);
                    $model2->nomor_tagihan = $model2->getInvoiceNumber($model2->status_tagihan);
                    if ($model2->status_tagihan == Tagihan::STATUS_PAID)
                        $model2->tanggal_pembayaran = date(c);

                    $model2->tanggal_input = date(c);
                    $model2->user_input = Yii::app()->user->id;
                    $model2->config=CJSON::encode(
                        array(
                            'items_belanja' => Yii::app()->user->getState('items_belanja'),
                            'items_payment' => Yii::app()->user->getState('items_payment'),
                            'customer' => Yii::app()->user->getState('customer'),
                            'promocode' => Yii::app()->user->getState('promocode'),
                        )
                    );
                    if ($model2->save()) {
                        $invoice_id = $model2->id;
                        foreach (Yii::app()->user->getState('items_belanja') as $index => $data) {
                            $model3 = new DetailTagihan;
                            $model3->id_produk = $data['id'];
                            $model3->id_tagihan = $model2->id;
                            $model3->jumlah = $data['qty'];
                            $model3->harga = $data['unit_price'];
                            $model3->diskon = $data['discount'];
                            if (Yii::app()->user->hasState('promocode')) {
                                $model3->id_promosi = Yii::app()->user->getState('promocode');
                                $model3->diskon = Promosi::getDiscountValue(Yii::app()->user->getState('promocode'), $model3->harga);
                            }
                            $model3->save();
                        }
                        Yii::app()->user->setState('items_belanja', null);
                        Yii::app()->user->setState('items_payment', null);
                        Yii::app()->user->setState('customer', null);
                        Yii::app()->user->setState('promocode', null);
                    }
                    //add queue for analytics
                    $this->addQueue($invoice_id);

                    echo CJSON::encode(array(
                        'status' => 'success',
                        'invoice_id' => $invoice_id,
                    ));
                    exit;
                }
            }
            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('_payment', array('model' => $model, 'id' => $_POST['id']), true, true),
            ));
            exit;
        }
    }

    public function actionPaymentRequestUpdate($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            //Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            //Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

            $model = new PaymentForm;
            if (isset($_POST['PaymentForm'])) {
                if (Yii::app()->user->hasState('items_belanja')) {
                    $model2 = Tagihan::model()->findByPk($id);
                    if (Yii::app()->user->hasState('customer')) {
                        $customer = Yii::app()->user->getState('customer');
                        $model2->id_pelanggan = (!empty($customer)) ? $customer->id : 0;
                    }
                    $model2->status_tagihan = Tagihan::STATUS_PAID;
                    $model2->total_tagihan = $this->money_unformat($_POST['PaymentForm']['amount_tendered']);
                    if ($model2->status_tagihan == Tagihan::STATUS_PAID)
                        $model2->tanggal_pembayaran = date(c);

                    $model2->config=CJSON::encode(
                        array(
                            'items_belanja' => Yii::app()->user->getState('items_belanja'),
                            'items_payment' => Yii::app()->user->getState('items_payment'),
                            'customer' => Yii::app()->user->getState('customer'),
                            'promocode' => Yii::app()->user->getState('promocode'),
                        )
                    );
                    if ($model2->save()) {
                        $invoice_id = $model2->id;
                        $del = DetailTagihan::model()->deleteAllByAttributes(array('id_tagihan'=>$invoice_id));
                        foreach (Yii::app()->user->getState('items_belanja') as $index => $data) {
                            $model3 = new DetailTagihan;
                            $model3->id_produk = $data['id'];
                            $model3->id_tagihan = $model2->id;
                            $model3->jumlah = $data['qty'];
                            $model3->harga = $data['unit_price'];
                            $model3->diskon = $data['discount'];
                            if (Yii::app()->user->hasState('promocode')) {
                                $model3->id_promosi = Yii::app()->user->getState('promocode');
                                $model3->diskon = Promosi::getDiscountValue(Yii::app()->user->getState('promocode'), $model3->harga);
                            }
                            $model3->save();
                        }
                        Yii::app()->user->setState('items_belanja', null);
                        Yii::app()->user->setState('items_payment', null);
                        Yii::app()->user->setState('customer', null);
                        Yii::app()->user->setState('promocode', null);
                    }
                    //add queue for analytics
                    /*if (Order::hasAnalyticConfig()) {
                        $queue = new Queue;
                        $queue->invoice_id = $invoice_id;
                        $queue->date_entry = date(c);
                        $queue->user_entry = Yii::app()->user->id;
                        $queue->save();
                    }*/

                    echo CJSON::encode(array(
                        'status' => 'success',
                        'invoice_id' => $invoice_id,
                    ));
                    exit;
                }
            }
            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('_payment', array('model' => $model, 'id' => $_POST['id']), true, true),
            ));
            exit;
        }
    }

    public function actionChangeRequest()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = true;
            $change = $this->money_unformat($_POST['amount_tendered']) - $this->getTotalBelanja();
            $model = new PaymentForm;
            Yii::app()->user->setState(
                'items_payment',
                array(
                    'amount_tendered' => $this->money_unformat($_POST['amount_tendered']),
                    'change' => $change,
                )
            );

            echo CJSON::encode(array(
                'status' => ($change >= 0) ? 'success' : 'failed',
                'div' => ($change >= 0) ? $this->renderPartial('_change', array('model' => $model, 'change' => $change), true, true) : 'Not enough tendered !',
            ));
            exit;
        }
    }

    public function actionDeleteItem()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (Yii::app()->user->hasState('items_belanja')) {
                $items = array();
                foreach (Yii::app()->user->getState('items_belanja') as $index => $data) {
                    if (!($index == $_POST['id']))
                        $items[$index] = $data;
                }
                Yii::app()->user->setState('items_belanja', $items);

                echo CJSON::encode(array(
                    'status' => 'success',
                    'div' => $this->renderPartial('_items', null, true, true),
                    'subtotal' => number_format($this->getTotalBelanja(), 0, ',', '.'),
                    'count' => count($items),
                ));
                exit;
            }
        }
    }

    public function actionCancelTransaction()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (Yii::app()->user->hasState('items_belanja')) {
                Yii::app()->user->setState('items_belanja', null);
                Yii::app()->user->setState('customer', null);
                Yii::app()->user->setState('promocode', null);

                echo CJSON::encode(array(
                    'status' => 'success',
                    'div' => $this->renderPartial('_items', null, true, true),
                    'subtotal' => number_format($this->getTotalBelanja(), 0, ',', '.'),
                ));
                exit;
            }
        }
    }

    public function actionViewItems()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

            $criteria = new CDbCriteria;

            if (Yii::app()->user->hasState('items_filter') & !isset($_POST['Produk']))
                $_POST = Yii::app()->user->getState('items_filter');

            if (isset($_POST['Produk'])) {
                //$criteria->compare('barcode', $_POST['Produk']['barcode'], true);
                $criteria->compare('LOWER(nama_produk)', strtolower($_POST['items_name']), true);
                Yii::app()->user->setState('items_filter', $_POST);
            }

            $dataProvider = new CActiveDataProvider('Produk', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 10,
                    'pageVar' => 'page',
                    'currentPage' => $_GET['page'] - 1,
                )
            ));

            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('_view_items', array('dataProvider' => $dataProvider), true, true),
            ));
            exit;
        }
    }

    public function actionPrint()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

            $amount_tendered = $this->money_unformat($_POST['amount_tendered']);
            $change = $amount_tendered - $this->getTotalBelanja();

            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('_print', array('amount_tendered' => $amount_tendered, 'change' => $change), true, true),
            ));
            exit;
        }
    }

    public function actionPromocode()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

            $criteria = new CDbCriteria;
            $criteria->compare('status_promosi', Promosi::STATUS_AKTIF);
            $criteria->compare('kode_promosi', $_POST['promocode']);

            $model = Promosi::model()->find($criteria);
            if (!empty($model->id)) {
                if (!empty($model->tanggal_berakhir_promosi)) {
                    if (strtotime($model->tanggal_berakhir_promosi) <= time())
                        Yii::app()->user->setState('promocode', $model->id);
                    else
                        Yii::app()->user->setState('promocode', null);
                } else
                    Yii::app()->user->setState('promocode', $model->id);

                if (Yii::app()->user->hasState('items_belanja')) {
                    $items = array();
                    foreach (Yii::app()->user->getState('items_belanja') as $index => $data) {
                        $data['discount'] = Promosi::getDiscountValue($model->id, $data['unit_price']);
                        $items[$index] = $data;
                    }
                    Yii::app()->user->setState('items_belanja', $items);
                    if (Yii::app()->user->hasState('promocode')) {
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'div' => 'Kode Promosi berhasil diaplikasikan.',
                            'cart' => $this->renderPartial('_items', null, true, true),
                            'subtotal' => number_format($this->getTotalBelanja(), 0, ',', '.'),
                        ));
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'failed',
                            'div' => Yii::t('order', 'Kode promosi tidak ditemukan atau kadaluarsa.'),
                        ));
                    }
                }
            } else {
                Yii::app()->user->setState('promocode', null);
                echo CJSON::encode(array(
                    'status' => 'failed',
                    'div' => Yii::t('order', 'Kode promosi tidak ditemukan atau kadaluarsa.'),
                ));
            }
            exit;
        }
    }

    public function getTotalBelanja()
    {
        $num = 0;
        if (Yii::app()->user->hasState('items_belanja')) {
            $items_belanja = Yii::app()->user->getState('items_belanja');
            foreach ($items_belanja as $index => $data) {
                $num = $num + ($data['unit_price'] * $data['qty']) - $data['discount'];
            }
        }
        return $num;
    }

    public function actionView()
    {
        $this->layout = 'column2';
        $criteria1 = new CDbCriteria;
        $criteria2 = new CDbCriteria;
        $criteria3 = new CDbCriteria;
        if (isset($_GET['Order'])) {
            $criteria1->compare('customer_id', $_GET['Order']['customer_id']);
            $criteria1->compare('id', $_GET['Order']['id']);
            $criteria1->addBetweenCondition('DATE_FORMAT(date_entry,"%Y-%m-%d")', $_GET['Order']['date_from'], $_GET['Order']['date_to'], 'AND');
            $criteria2->compare('customer_id', $_GET['Order']['customer_id']);
            $criteria2->compare('id', $_GET['Order']['id']);
            $criteria2->addBetweenCondition('DATE_FORMAT(date_entry,"%Y-%m-%d")', $_GET['Order']['date_from'], $_GET['Order']['date_to'], 'AND');
            $criteria3->compare('customer_id', $_GET['Order']['customer_id']);
            $criteria3->compare('id', $_GET['Order']['id']);
            $criteria3->addBetweenCondition('DATE_FORMAT(date_entry,"%Y-%m-%d")', $_GET['Order']['date_from'], $_GET['Order']['date_to'], 'AND');
        }

        $criteria1->order = 'date_entry DESC';
        $dataProvider = new CActiveDataProvider('Order', array('criteria' => $criteria1));

        $criteria2 = new CDbCriteria;
        $criteria2->compare('type', 0);
        $criteria2->order = 'date_entry DESC';
        $creditProvider = new CActiveDataProvider('Order', array('criteria' => $criteria2));

        $criteria3 = new CDbCriteria;
        $criteria3->compare('type', 1);
        $criteria3->order = 'date_entry DESC';
        $cashProvider = new CActiveDataProvider('Order', array('criteria' => $criteria3));

        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'creditProvider' => $creditProvider,
            'cashProvider' => $cashProvider
        ));
    }

    public function actionUpdate($id)
    {
        $model = Order::model()->findByPk($id);
        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $model->date_update = date(c);
            $model->user_update = Yii::app()->user->id;
            if ($model->save()) {
                Yii::app()->user->setFlash('update', Yii::t('global', 'Your data has been saved successfully.'));
                $this->refresh();
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionCreateDiscount()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (Yii::app()->user->hasState('items_belanja')) {
                $items_belanja = Yii::app()->user->getState('items_belanja');
                $id = $_POST['id'];
                $items_belanja[$id]['discount'] = $this->money_unformat($_POST['value']);
                //$items_belanja[$id]['qty']=2;
                //renew cart
                Yii::app()->user->setState('items_belanja', $items_belanja);
                echo CJSON::encode(array(
                    'status' => 'success',
                ));
                exit;
            }
        }
    }

    public function actionSetCurrency()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if (Yii::app()->user->hasState('items_belanja')) {
                $items_belanja = Yii::app()->user->getState('items_belanja');
                Yii::app()->user->setState('currency', $_POST['value']);
                foreach ($items_belanja as $index => $data) {
                    /*$items[$index]=array(
                                'id'=>$model->id,
                                'barcode'=>$model->barcode,
                                'name'=>$model->name,
                                'desc'=>$model->description,
                                'cost_price'=>$model->price->purchase_price,
                                'unit_price'=>$model->price->sold_price,
                                'qty'=>1,
                                'discount'=>0,
                                'currency'=>$currency,
                                'change_value'=>Currency::getChangeValue($currency),
                            );*/
                    $Produk = Produk::model()->findByPk($data['id']);
                    $items_belanja[$index]['currency'] = $_POST['value'];
                    $items_belanja[$index]['change_value'] = Currency::getChangeValue($_POST['value']);
                    if (Currency::getChangeValue($_POST['value']) > 0) {
                        $items_belanja[$index]['unit_price'] = round($Produk->price->sold_price / Currency::getChangeValue($_POST['value']), 2);
                        $items_belanja[$index]['discount'] = round($data['discount'] / Currency::getChangeValue($_POST['value']), 2);
                    }
                }
                Yii::app()->user->setState('items_belanja', $items_belanja);
                echo CJSON::encode(array(
                    'status' => 'success',
                ));
                exit;
            }
        }
    }

    public function actionChange($id)
    {
        $model = Tagihan::model()->findByPk($id);
        $config = CJSON::decode($model->config);
        foreach($config as $index=>$data){
            Yii::app()->user->setState($index,$data);
        }

        $this->render('change',array(
            'model'=>$model,
            'promocode'=>Yii::app()->user->getState('promocode'),
            'customer'=>($model->id_pelanggan>0)? $model->id_pelanggan.' - '.$model->pelanggan_rel->nama_pelanggan : ''
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            Order::model()->findByPk($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    private function addQueue($invoice_id)
    {
        $path = Yii::getPathOfAlias('application.data');
        if (!is_writable($path)){
            throw new CHttpException(400, 'Please make sure this folder is writable: '.$path.'.');
        }
        $file = $path.'/'.Tagihan::QUEUE_FILE_NAME;
        if(!file_exists($file)){
            $fh = fopen($file, 'w');
        }
        $json = json_decode(file_get_contents($file),true);

        $tagihan = Tagihan::model()->findByPk($invoice_id);
        $data = array();
        $data[$invoice_id] = array(
            'tagihan' => $tagihan->attributes
        );

        if(is_array($json)){
            $json[$invoice_id] = $data[$invoice_id];
        }else{
            $json = $data;
        }

        $write = file_put_contents($file, json_encode($json));
        return ($write>0)? true : false;
    }
}