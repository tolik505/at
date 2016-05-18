<?php
/**
 * @var $form FormBuilder
 * @var $model ActiveRecord
 * @var $attribute string
 * @var $element array
 */
use backend\components\FormBuilder;
use common\components\model\ActiveRecord;
use yii\helpers\Html;

echo Html::beginTag('div', ['class' => 'row']);
    echo Html::beginTag('div', ['class' => 'col-sm-12']);
        echo $form->renderField($model, $attribute, $element);
        echo $form->renderUploadedFile($model, $attribute, $element);
        if (!empty($translationModels) && $model->isTranslateAttribute($attribute)) {
            foreach ($translationModels as $languageModel) {
                echo Html::beginTag('div', ['class' => 'row']);
                    echo Html::beginTag('div', ['class' => 'col-sm-12']);
                        echo $form->renderField($languageModel, '[' . $languageModel->language . ']' . $attribute, $element);
                        echo $form->renderUploadedFile($languageModel, $attribute, $element, $languageModel->language);
                    echo Html::endTag('div');
                echo Html::endTag('div');
            }
        }
    echo Html::endTag('div');
echo Html::endTag('div');
