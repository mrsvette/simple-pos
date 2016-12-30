<?php

class TagihanController extends Controller
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'printPreview', 'refund'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete', 'deleteItem'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView()
    {
        $criteria1 = new CDbCriteria;
        $criteria2 = new CDbCriteria;
        $criteria3 = new CDbCriteria;
        $criteria4 = new CDbCriteria;
        if (isset($_GET['Tagihan'])) {
            $criteria1->compare('id_pelanggan', $_GET['Tagihan']['id_pelanggan']);
            $criteria1->compare('id', $_GET['Tagihan']['id']);
            $criteria1->addBetweenCondition('DATE_FORMAT(tanggal_input,"%Y-%m-%d")', $_GET['Tagihan']['date_from'], $_GET['Tagihan']['date_to'], 'AND');
            $criteria2->compare('id_pelanggan', $_GET['Tagihan']['id_pelanggan']);
            $criteria2->compare('id', $_GET['Tagihan']['id']);
            $criteria2->addBetweenCondition('DATE_FORMAT(tanggal_input,"%Y-%m-%d")', $_GET['Tagihan']['date_from'], $_GET['Tagihan']['date_to'], 'AND');
            $criteria3->compare('id_pelanggan', $_GET['Tagihan']['id_pelanggan']);
            $criteria3->compare('id', $_GET['Tagihan']['id']);
            $criteria3->addBetweenCondition('DATE_FORMAT(tanggal_input,"%Y-%m-%d")', $_GET['Tagihan']['date_from'], $_GET['Tagihan']['date_to'], 'AND');
            $criteria4->compare('id_pelanggan', $_GET['Tagihan']['id_pelanggan']);
            $criteria4->compare('id', $_GET['Tagihan']['id']);
            $criteria4->addBetweenCondition('DATE_FORMAT(tanggal_input,"%Y-%m-%d")', $_GET['Tagihan']['date_from'], $_GET['Tagihan']['date_to'], 'AND');
        }
        $criteria1->order = 'tanggal_input DESC';
        $dataProvider = new CActiveDataProvider('Tagihan', array('criteria' => $criteria1));

        $criteria2->compare('status_tagihan', Tagihan::STATUS_UNPAID);
        $criteria2->order = 'tanggal_input DESC';
        $unpaidProvider = new CActiveDataProvider('Tagihan', array('criteria' => $criteria2));

        $criteria3->compare('status_tagihan', Tagihan::STATUS_PAID);
        $criteria3->order = 'tanggal_input DESC';
        $paidProvider = new CActiveDataProvider('Tagihan', array('criteria' => $criteria3));

        $criteria4->compare('status_tagihan', Tagihan::STATUS_REFUND);
        $criteria4->order = 'tanggal_input DESC';
        $refundProvider = new CActiveDataProvider('Tagihan', array('criteria' => $criteria4));

        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'unpaidProvider' => $unpaidProvider,
            'paidProvider' => $paidProvider,
            'refundProvider' => $refundProvider,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Tagihan;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tagihan'])) {
            $model->attributes = $_POST['Tagihan'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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

        if (isset($_POST['Tagihan'])) {
            $model->attributes = $_POST['Tagihan'];
            if ($model->save()){
                Yii::app()->user->setFlash('update', 'Data tegihan telah berhasil diubah.');
                $this->refresh();
            }
        }

        $criteria = new CDbCriteria;
        $criteria->compare('id_tagihan',$model->id);
        $itemsProvider = new CActiveDataProvider('DetailTagihan',array('criteria'=>$criteria));

        $this->render('update', array(
            'model' => $model,
            'itemsProvider' => $itemsProvider
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = Tagihan::model()->findByPk($id);
        if($model->delete()){
            DetailTagihan::model()->deleteAllByAttributes(array('id_tagihan'=>$id));
            $queue = Tagihan::getQueue();
            if(in_array($id, array_keys($queue))){
                unset($queue[$id]);
                Tagihan::setQueue($queue);
            }
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionDeleteItem($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = DetailTagihan::model()->findByPk($id);
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }


    public function actionPrintPreview($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $model = Tagihan::model()->findByPk($id);
            $print = false;
            if (isset($_POST['new_order']))
                $print = true;
            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('_print_preview', array('model' => $model, 'print' => $print), true, true),
                'Tagihan_number' => $model->nomor_tagihan,
            ));
            exit;
        }
    }

    public function actionRefund($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            $model->status_tagihan = Tagihan::STATUS_REFUND;
            if($model->save()){
                echo CJSON::encode(array(
                    'status' => 'success',
                    'div' => Tagihan::STATUS_REFUND,
                ));
                exit;
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tagihan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Tagihan::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Tagihan $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tagihan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
