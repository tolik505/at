<?php

use app\modules\request\models\Request;
use yii\widgets\ActiveForm;

?>

<div class="popup">
    <p class="close" style="background-image: url(/img/content/close.png) "></p>
    <p class="form_title"><?= \Yii::t('front_static', 'mail us') ?></p>
        <?php
        $form = ActiveForm::begin([
            'action' => Request::getRequestMailUsUrl(),
            'options' => [
                'class' => 'ajax-form',
                'id' => 'mail-us-form',
            ],
            'enableAjaxValidation' => false,
            'errorCssClass' => 'has-error',
            'fieldConfig' => [
                'template' => "{input}\n<span class='underline'></span>\n{error}\n{hint}",
                'errorOptions' => ['class' => 'help-block']
            ]
        ]); ?>

        <?= $form->field($model, 'name', [
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Name'],
            'options' => ['class' => 'form-group']
        ]); ?>

        <?= $form->field($model, 'email', [
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'E-mail'],
            'options' => ['class' => 'form-group']
        ]); ?>

        <?= $form->field($model, 'message', [
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Message', 'cols' => 47, 'rows' => 5],
            'options' => ['class' => 'form-group']
        ])->textarea(); ?>

        <div class="btn_form">
            <button class="get_btn form-submit"><span class="btn_get_text"><?= \Yii::t('front_static', 'Sent message') ?></span></button>
        </div>

    <?php ActiveForm::end(); ?>

</div>