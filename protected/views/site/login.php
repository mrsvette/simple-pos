<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
$this->menu = array(
    array('label' => '<i class="fa fa-lock"></i> Login Page', 'url' => array('login')),
);
?>
<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 mt50" id="div-for-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="fa fa-sign-in"></i>Login</h6>
        </div>
        <div class="panel-body">
            <?php if (Yii::app()->user->hasFlash('login')): ?>

                <div class="alert alert-info fade in widget-inner">
                    <?php
                    header('refresh: 2; url=' . Yii::app()->user->returnUrl);
                    echo Yii::app()->user->getFlash('login');
                    ?>
                </div>

            <?php endif; ?>
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); ?>
            <p class="mt5 mb20">Silakan masukkan username dan password Anda untuk mengakses akun.</p>
            <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-warning alert-block alert-dismissable fade in')); ?>
            <div class="form-group">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control uname', 'placeholder' => 'Username')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control pword', 'placeholder' => 'Password')); ?>
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton(Yii::t('global', 'Login'), array('style' => 'min-width:100px;', 'id' => 'tombol', 'class' => 'btn btn-success btn-block')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div><!-- panel-body -->
    </div>
</div><!-- div-for-form -->

<script type="text/javascript">
    $(function () {
        $('body').addClass('leftpanel-collapsed');
        $('input[id="LoginForm_username"]').focus();
    });
</script>
