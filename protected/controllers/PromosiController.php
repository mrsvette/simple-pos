<?php

class PromosiController extends Controller
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
                'actions' => array('index', 'view'),
                'expression' => 'UserAccess::ruleAccess(\'read_p\')',
            ),
            array('allow',
                'actions' => array('create'),
                'expression' => 'UserAccess::ruleAccess(\'create_p\')',
            ),
            array('allow',
                'actions' => array('update'),
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Promosi;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Promosi'])) {
            $model->attributes = $_POST['Promosi'];
            if(!empty($model->produk_yang_terdiskon)){
                $model->produk_yang_terdiskon = CJSON::encode($model->produk_yang_terdiskon);
            }
            if(!empty($model->tanggal_mulai_promosi)){
                $model->tanggal_mulai_promosi = date("Y-m-d", strtotime($model->tanggal_mulai_promosi));
            }
            if(!empty($model->tanggal_berakhir_promosi)){
                $model->tanggal_berakhir_promosi = date("Y-m-d", strtotime($model->tanggal_berakhir_promosi));
            }
            $model->tanggal_input = date(c);
            $model->user_input = Yii::app()->user->id;
            if ($model->save()){
                Yii::app()->user->setFlash('create', 'Data promosi berhasil disimpan.');
                $this->refresh();
            }
        }

        $this->render('create', array(
            'model' => $model,
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
        if(!empty($model->produk_yang_terdiskon)){
            $model->produk_yang_terdiskon = CJSON::decode($model->produk_yang_terdiskon, true);
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Promosi'])) {
            $model->attributes = $_POST['Promosi'];
            if(!empty($model->produk_yang_terdiskon)){
                $model->produk_yang_terdiskon = CJSON::encode($model->produk_yang_terdiskon);
            }
            if(!empty($model->tanggal_mulai_promosi)){
                $model->tanggal_mulai_promosi = date("Y-m-d", strtotime($model->tanggal_mulai_promosi));
            }
            if(!empty($model->tanggal_berakhir_promosi)){
                $model->tanggal_berakhir_promosi = date("Y-m-d", strtotime($model->tanggal_berakhir_promosi));
            }
            if ($model->save()){
                Yii::app()->user->setFlash('update', 'Data promosi berhasil disimpan.');
                $this->refresh();
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
        $model = new Promosi('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Promosi']))
            $model->attributes = $_GET['Promosi'];

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Promosi the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Promosi::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Promosi $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'promosi-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
