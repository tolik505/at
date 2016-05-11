<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use  \backend\components\FormBuilder;

/* @var $this yii\web\View */
/* @var $model \common\components\model\ActiveRecord */
/* @var $form yii\bootstrap\ActiveForm */
//\udokmeci\yii2kt\assets\CustomSirTrevorAsset::register($this);

$translationModels = [];
if ($model instanceof \common\components\model\Translateable) {
    $translationModels = $model->getTranslationModels();
}
$action = isset($action) ? $action : '';
?>

<div class="menu-form">
    <?= Html::errorSummary(
        \yii\helpers\ArrayHelper::merge([$model], $translationModels),
        [
            'class' => 'alert alert-danger'
        ]
    );
    ?>
    <?php /** @var FormBuilder $form */
    $form = FormBuilder::begin([
        'action' => $action,
        'enableClientValidation' => true,
        'options' => [
            'id' => 'main-form',
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <?php
    $items = [];

    $formConfig = $model->getFormConfig();

    if (isset($formConfig['form-set'])) {
        $i = 0;
        foreach ($formConfig['form-set'] as $tabName => $tabConfig) {
            $class = 'tab_content_' . ++$i;
            $items[] = [
                'label' => $tabName,
                'content' => $form->prepareRows($model, $tabConfig, $translationModels, true),
                'options' => [
                    'class' => $class,
                ],
                'linkOptions' => [
                    'class' => $class,
                ],
            ];
        }
    } else {
        $items[] = [
            'label' => 'Content',
            'content' => $form->prepareRows($model, $formConfig, $translationModels),
            'active' => true,
            'options' => [
                'class' => 'tab_content_content',
            ],
            'linkOptions' => [
                'class' => 'tab_content',
            ],
        ];
    }

    $seo = $model->getBehavior('seo');
    if ($seo && $seo instanceof \notgosu\yii2\modules\metaTag\components\MetaTagBehavior) {
        $seo = \notgosu\yii2\modules\metaTag\widgets\metaTagForm\Widget::widget(['model' => $model, ]);
        $items[] = [
            'label' => 'SEO',
            'content' => $seo,
            'active' => false,
            'options' => [
                'class' => 'tab_seo_content',
            ],
            'linkOptions' => [
                'class' => 'tab_seo',
            ],
        ];
    }

    ?>

    <?= \yii\bootstrap\Tabs::widget(['items' => $items]) ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
            </div>
        </div>
    </div>

    <?php FormBuilder::end(); ?>

</div>
