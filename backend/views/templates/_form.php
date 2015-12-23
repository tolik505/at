<?php

use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;

/* @var $this yii\web\View */
/* @var $model \backend\components\BackendModel */
/* @var $form yii\bootstrap\ActiveForm */
$translationModels = [];
if ($model instanceof \common\components\model\Translateable) {
    $translationModels = $model->getTranslationModels();
}
?>

<div class="menu-form">
    <?= Html::errorSummary(
        \yii\helpers\ArrayHelper::merge([$model], $translationModels),
        [
            'class' => 'alert alert-danger'
        ]
    );
    ?>
    <?php /** @var \metalguardian\formBuilder\ActiveFormBuilder $form */ $form = \metalguardian\formBuilder\ActiveFormBuilder::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <?php
    $items = [];


    $formConfig = $model->getFormConfig();

    $content = null;
    foreach ($formConfig as $attribute => $element) {
        $content .= $form->renderField($model, $attribute, $element);
        if ($element['type'] == \metalguardian\formBuilder\ActiveFormBuilder::INPUT_FILE && isset($model->$attribute)) {
            $file = FPM::transfer()->getData($model->$attribute);
            $content .= Html::beginTag('div', ['class' => 'file-name']);
            $content .= Html::button(Yii::t('app', 'Delete file'), [
                    'class' => 'delete-file',
                    'data' => [
                        'modelName' => $model->className(),
                        'modelId' => $model->id,
                        'attribute' => $attribute
                    ]
                ]);
            if (in_array($file->extension, ['jpg', 'png', 'gif', 'tif', 'bmp'])) {
                $linkLabel = FPM::image($file->id, 'admin', 'file');
            } else {
                $linkLabel = FPM::getOriginalFileName($file->id, $file->base_name, $file->extension);
            }
            $content .= Html::a(
                $linkLabel,
                FPM::originalSrc($model->$attribute),
                ['target' => '_blank']
            );
            $content .= Html::endTag('div');
        }
        if ($model instanceof \common\components\model\Translateable && $model->isTranslateAttribute($attribute)) {
            foreach ($translationModels as $languageModel) {
                $content .= $form->renderField($languageModel, '[' . $languageModel->language . ']' . $attribute, $element);
            }
        }
    }

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php \metalguardian\formBuilder\ActiveFormBuilder::end(); ?>

</div>
