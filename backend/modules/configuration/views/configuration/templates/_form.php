<?php

use common\helpers\LanguageHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\modules\configuration\components\ConfigurationModel */

$values = $model->getModels();
?>

<div class="menu-form">
    <?= Html::errorSummary(
        $values,
        [
            'class' => 'alert alert-danger'
        ]
    );
    ?>
    <?php /** @var \backend\modules\configuration\components\ConfigurationFormBuilder $form */
    $form = \backend\modules\configuration\components\ConfigurationFormBuilder::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <?php
    $items = [];

    $content = null;
    foreach ($values as $value) {
        $attribute = '[' . $value->id . ']value';
        $configuration = $value->getValueFieldConfig();
        $configuration['label'] = $value->description . ' [key: ' . $value->id . '] [language: ' . LanguageHelper::getCurrent()->code . ']';
        $content .= $form->renderField($value, $attribute, $configuration);
        $content .= $form->renderUploadedFile($value, 'value', $configuration);
        if ($value instanceof \common\components\model\Translateable && $value->isTranslateAttribute($attribute)) {
            foreach ($value->getTranslationModels() as $languageModel) {
                $configuration['label'] = $value->description . ' [key: ' . $value->id . '] [language: ' . $languageModel->language . ']';
                $content .= $form->renderField($languageModel, '[' . $languageModel->language . ']' . $attribute,
                    $configuration);
                $content .= $form->renderUploadedFile($languageModel, 'value', $configuration,
                    $languageModel->language);
            }
        }
    }

    if (!is_null($content)) {
        $items[] = [
            'label' => 'Content',
            'content' => $content,
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
        $seo = \notgosu\yii2\modules\metaTag\widgets\metaTagForm\Widget::widget(['model' => $model,]);
        $items[] = [
            'label' => 'SEO',
            'content' => $seo,
            'active' => (is_null($content)) ? true : false,
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

    <?php \backend\modules\configuration\components\ConfigurationFormBuilder::end(); ?>

</div>
