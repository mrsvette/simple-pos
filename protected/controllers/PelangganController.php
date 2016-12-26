<?php

class PelangganController extends Controller
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
                'actions' => array('choose'),
                'users' => array('@'),
            ),
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pelanggan'])) {
            $model->attributes = $_POST['Pelanggan'];
            if ($model->save()){
                Yii::app()->user->setFlash('update', 'Data pelanggan berhasil disimpan.');
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
        $model = new Pelanggan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pelanggan']))
            $model->attributes = $_GET['Pelanggan'];

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionChoose()
    {
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            if (isset($_POST['id']))
                $id = $_POST['id'];
            elseif (isset($_POST['nama'])) {
                $str = explode(" - ", $_POST['nama']);
                $id = (int)$str[0];
            }

            $model = Pelanggan::model()->findByPk($id);
            if (count($model) > 0) {
                Yii::app()->user->setState('customer', $model);
                echo CJSON::encode(array('status' => 'success', 'div' => $model->nama_pelanggan));
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pelanggan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Pelanggan::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pelanggan $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pelanggan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
