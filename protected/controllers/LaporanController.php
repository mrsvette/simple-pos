<?php

class LaporanController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

	public function behaviors()
	{
		return array(
		    'eexcelview'=>array(
		        'class'=>'ext.eexcelview.EExcelBehavior',
		    ),
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
                'actions' => array('index', 'view', 'dashboard', 'plot', 'detail'),
                'expression' => 'UserAccess::ruleAccess(\'read_p\')',
            ),
            array('allow',
                'actions' => array('create', 'exportExcel', 'analitik', 'push', 'pull'),
                'expression' => 'UserAccess::ruleAccess(\'create_p\')',
            ),
            array('allow',
                'actions' => array('pull'),
                'users' => array('*'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Pelanggan;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pelanggan'])) {
            $model->attributes = $_POST['Pelanggan'];
            $model->tanggal_input = date(c);
            $model->user_input = Yii::app()->user->id;
            if ($model->save()){
                Yii::app()->user->setFlash('create', 'Data pelanggan berhasil disimpan.');
                $this->refresh();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->forward('view');
    }

    /**
     * Manages all models.
     */
    public function actionView()
    {
		$data_from = (!empty($_GET['Tagihan']['date_from']))? strtotime($_GET['Tagihan']['date_from']) : time()-(24*3600);
		$data_to = (!empty($_GET['Tagihan']['date_to']))? strtotime($_GET['Tagihan']['date_to']) : time();
		$rawData = array();
		for($i = $data_from; $i <= $data_to; $i = $i+86400) {
			$rawData[] = array(
					'date' => date('Y-m-d', $i),
					'total_pembelian' => Tagihan::getCountOrderItemDate(date('Y-m-d', $i)),
					'total_pendapatan' => Tagihan::getTotalOrderDate(date('Y-m-d', $i)),
				);
		}

		$dataProvider = new CArrayDataProvider($rawData, array(
			'id' => 'date-order',
			'sort' => array(
				'attributes' => array(
				     'id', 'username', 'email',
				),
			),
			'pagination' => array(
				'pageSize' => 20,
			),
		));
		$this->render('view',array(
			'dataProvider' => $dataProvider,
			'model' => new Tagihan,
		));
    }

	public function actionDetail($date)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('DATE_FORMAT(tagihan_rel.tanggal_input, \'%Y-%m-%d\')',date("Y-m-d",strtotime($date)));
		$criteria->group = 't.id_produk';
		$criteria->with = array('tagihan_rel');
		$criteria->order = 'tagihan_rel.tanggal_input ASC';

		$dataProvider = new CActiveDataProvider('DetailTagihan',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>100)));
		$this->render('detail',array(
			'dataProvider' => $dataProvider,
			'date' => date("Y-m-d",strtotime($date)),
			'total_order' => number_format(Tagihan::getTotalOrderDate(date("Y-m-d",strtotime($date))),0,',','.'),
		));
	}

    public function actionDashboard()
    {
		$criteria = new CDbCriteria;
		$criteria->compare('DATE_FORMAT(tanggal_input, \'%Y-%m-%d\')',date("Y-m-d"));
		$criteria->order = 'tanggal_input ASC';

		$dataProvider = new CActiveDataProvider('Tagihan',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>20)));
		
		$this->render('dashboard',array('dataProvider'=>$dataProvider));
    }

	public function actionPlot()
	{
	    if(Yii::app()->request->isAjaxRequest)
	    {
	    	echo CJSON::encode(array(
				'status' => 'success',
				'income' => CJSON::encode(Tagihan::getStatistikMonthly('income')),
			));
	    }
	}

	public function actionExportExcel($date)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('DATE_FORMAT(tagihan_rel.tanggal_input, \'%Y-%m-%d\')',date("Y-m-d",strtotime($date)));
		$criteria->group = 't.id_produk';
		$criteria->with = array('tagihan_rel');
		$criteria->order = 'tagihan_rel.tanggal_input ASC';

		$model = DetailTagihan::model()->findAll($criteria);
		$columns = array(
				array(
					'header'=>Yii::t('order','Item Name'),
					'value'=>'$data->produk_rel->nama_produk',
					'footer'=>'TOTAL',
				),
				array(
					'header'=>Yii::t('order','Total Item'),
					'value'=>'Tagihan::getCountOrderItemDate(date("Y-m-d",strtotime($data->tagihan_rel->tanggal_input)),$data->id_produk)',
					'footer'=>Tagihan::getCountOrderItemDate(date("Y-m-d",strtotime($date))), 
				),
				array(
					'header'=>'Harga',
					'value'=>'$data->harga',
				),
				array(
					'header'=>'Sub Total',
					'value'=>'Tagihan::getTotalOrderDate(date("Y-m-d",strtotime($data->tagihan_rel->tanggal_input)),$data->id_produk)',
					'footer'=>Tagihan::getTotalOrderDate(date("Y-m-d",strtotime($date))), 
				),
			);

		$this->toExcel($model,$columns, 'Laporan Pendapatan '.date("d F Y",strtotime($date)), array(), 'Excel2007');
	}

	public function actionAnalitik()
	{
        $dataProvider = new CArrayDataProvider(Tagihan::getQueue(), array(
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('analitik',array(
            'dataProvider' => $dataProvider
        ));
	}

    public function actionPush()
    {
        if(Yii::app()->request->isAjaxRequest ){
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $models = Tagihan::getQueue();
            foreach($models as $id_tagihan => $model){
                $tagihan = Tagihan::model()->findByPk($id_tagihan);
                //detail tagihan
                $details = array(); $products = array();
                if($tagihan->items_count > 0){
                    foreach ($tagihan->items_rel as $detail){
                        $details[] = $detail->attributes;
                        $products[$detail->id_produk] = $detail->produk_rel->attributes;
                    }
                }
                $data = array(
                    'tagihan' => $tagihan->attributes,
                    'detail_tagihan' => $details,
                    'pelanggan' => $tagihan->customer_rel->attributes,
                    'produk' => $products,
                );
                $curl = $this->get_curl(
                    Yii::app()->params['analitik_url'],
                    array(
                        'data'=>$data
                    )
                );
                $respon = CJSON::decode($curl);

                if($respon['success']){
                    unset($models[$id_tagihan]);
                    Tagihan::setQueue($models);
                }
            }

            echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'<div class="alert alert-success">Laporan berhasil diupload.</div>',
            ));
            exit;
        }
    }

    private function get_curl($url, $post_vars = false)
    {
        //url-ify the data for the POST
        $fields_string = http_build_query($post_vars);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);
        if(curl_error($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        //close connection
        curl_close($ch);
        return $result;
    }

    public function actionPull()
    {
        if(isset($_POST['data']['tagihan'])){
            $tagihan = Tagihan::model()->findByPk($_POST['data']['tagihan']['id']);
            if(empty($tagihan)){
                $tagihan = new Tagihan;
                $tagihan->attributes = $_POST['data']['tagihan'];
                if($tagihan->save()){
                    //save the detail
                    foreach ($_POST['data']['detail_tagihan'] as $id => $dattributes){
                        $dtagihan = new DetailTagihan;
                        $dtagihan->attributes = $dattributes;
                        $dtagihan->save();
                    }
                    //save produk
                    foreach ($_POST['data']['produk'] as $idp => $pattributes){
                        $produk = Produk::model()->findByPk($pattributes['id']);
                        if(empty($produk))
                            $produk = new Produk;
                        $produk->attributes = $dattributes;
                        $produk->save();
                    }
                    //save pelanggan
                    if(isset($_POST['data']['pelanggan'])){
                        $pelanggan = Pelanggan::model()->findByPk($_POST['data']['pelanggan']['id']);
                        if(empty($pelanggan))
                            $pelanggan = new Pelanggan;
                        $pelanggan->attributes = $_POST['data']['pelanggan'];
                        $pelanggan->save();
                    }
                    echo CJSON::encode(array('success'=>true)); exit;
                }
            }
            echo CJSON::encode(array('success'=>false)); exit;
        }
        echo CJSON::encode(array('success'=>false));
        exit;
    }
}
