<?php

class ProdukController extends Controller
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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create'),
                'expression' => 'UserAccess::ruleAccess(\'create_p\')',
            ),
            array('allow',
                'actions' => array('view', 'index'),
                'expression' => 'UserAccess::ruleAccess(\'read_p\')',
            ),
            array('allow',
                'actions' => array('update'),
                'expression' => 'UserAccess::ruleAccess(\'update_p\')',
            ),
            array('allow',
                'actions' => array('delete', 'deleteDiscount'),
                'expression' => 'UserAccess::ruleAccess(\'delete_p\')',
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
        $model = new Produk;
        $model2 = new ProdukDiskon;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Produk'])) {
            $model->attributes = $_POST['Produk'];
            $model->tanggal_input = date(c);
            $model->user_input = Yii::app()->user->id;
            if ($model->save()){
                foreach($_POST['ProdukDiskon']['harga_produk'] as $i => $value){
                    if($value > 0){ //hanya jika harga_produk lebih dari 0
                        $model3 = new ProdukDiskon;
                        $model3->id_produk = $model->id;
                        $model3->harga_produk = (int)$_POST['ProdukDiskon']['harga_produk'][$i];
                        $model3->jumlah_produk = (int)$_POST['ProdukDiskon']['jumlah_produk'][$i];
                        $model3->tanggal_mulai_diskon = (strtotime($_POST['ProdukDiskon']['tanggal_mulai_diskon'][$i])>0)? date("Y-m-d H:i:s",strtotime($_POST['ProdukDiskon']['tanggal_mulai_diskon'][$i])) : date(c);
                        $model3->tanggal_berakhir_diskon = (strtotime($_POST['ProdukDiskon']['tanggal_berakhir_diskon'][$i])>0)? date("Y-m-d H:i:s",strtotime($_POST['ProdukDiskon']['tanggal_berakhir_diskon'][$i])) : date(c);
                        $model3->tanggal_input = date(c);
                        $model3->user_input = Yii::app()->user->id;
                        $model3->save(); //eksekusi simpan data
                    }
                }
                Yii::app()->user->setFlash('create', 'Data produk berhasil disimpan.');
                $this->refresh();
            }
        }

        $this->render('create', array(
            'model' => $model,
            'model2' => $model2
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if($model->diskon_rel_count <=0 )
            $model2 = new ProdukDiskon;
        else
            $model2 = $model->diskon_rel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Produk'])) {
            $model->attributes = $_POST['Produk'];
            if ($model->save()){
                if(isset($_POST['ProdukDiskon']) && (count($_POST['ProdukDiskon']) > 0)){
                    //delete semua data diskon untuk produk id = $id
                    $deletediskon = ProdukDiskon::model()->deleteAllByAttributes(array('id_produk' => $model->id));
                    foreach($_POST['ProdukDiskon']['harga_produk'] as $i => $value){
                        if($value > 0){ //hanya jika harga_produk lebih dari 0
                            $model3 = new ProdukDiskon;
                            $model3->id_produk = $model->id;
                            $model3->harga_produk = (int)$_POST['ProdukDiskon']['harga_produk'][$i];
                            $model3->jumlah_produk = (int)$_POST['ProdukDiskon']['jumlah_produk'][$i];
                            $model3->tanggal_mulai_diskon = (strtotime($_POST['ProdukDiskon']['tanggal_mulai_diskon'][$i])>0)? date("Y-m-d H:i:s",strtotime($_POST['ProdukDiskon']['tanggal_mulai_diskon'][$i])) : date(c);
                            $model3->tanggal_berakhir_diskon = (strtotime($_POST['ProdukDiskon']['tanggal_berakhir_diskon'][$i])>0)? date("Y-m-d H:i:s",strtotime($_POST['ProdukDiskon']['tanggal_berakhir_diskon'][$i])) : date(c);
                            $model3->tanggal_input = date(c);
                            $model3->user_input = Yii::app()->user->id;
                            $model3->save(); //eksekusi simpan data
                        }
                    }
                }
                Yii::app()->user->setFlash('update', 'Data produk berhasil disimpan.');
                $this->refresh();
            }
        }

        $this->render('update', array(
            'model' => $model,
            'model2' => $model2
        ));
    }

    public function actionIndex()
    {
        $this->forward('view');
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $deletediskon = ProdukDiskon::model()->deleteAllByAttributes(array('id_produk' => $model->id));
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDeleteDiscount($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = ProdukDiskon::model()->findByPk($id);
            if($model->delete()){
                echo CJSON::encode(array('status' => 'success'));
            }else{
                echo CJSON::encode(array('status' => 'failed'));
            }
            exit;
        }
    }

    /**
     * Manages all models.
     */
    public function actionView()
    {
        $model = new Produk('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Produk']))
            $model->attributes = $_GET['Produk'];

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Produk the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Produk::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Produk $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'produk-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
