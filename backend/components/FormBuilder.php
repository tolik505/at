<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 30.12.15
 * Time: 9:40
 */

namespace backend\components;


use common\components\model\ActiveRecord;
use metalguardian\fileProcessor\helpers\FPM;
use metalguardian\formBuilder\ActiveFormBuilder;
use tolik505\relatedForm\RelatedFormWidget;
use yii\helpers\Html;

/**
 * Class FormBuilder
 *
 * @package backend\components
 */
class FormBuilder extends ActiveFormBuilder
{
    /**
     * @param $attribute
     * @param array $element
     * @param ActiveRecord $model
     * @param string|null $language
     *
     * @return string
     */
    public function renderUploadedFile($model, $attribute, $element, $language = null)
    {
        $content = '';
        if ($element['type'] == static::INPUT_FILE && isset($model->$attribute) && $model->$attribute) {
            $file = FPM::transfer()->getData($model->$attribute);
            $content .= Html::beginTag('div', ['class' => 'file-name']);
            $content .= Html::button(\Yii::t('app', 'Delete file'), [
                'class' => 'delete-file',
                'data' => [
                    'modelName' => $model->className(),
                    'modelId' => $language ? $model->model_id : $model->id,
                    'attribute' => $attribute,
                    'language' => $language
                ]
            ]);
            $content .= Formatter::getFileLink($file);
            $content .= Html::endTag('div');
        }
        return $content;
    }

    /**
     * @param $model ActiveRecord
     * @param $formConfig array
     * @param $translationModels ActiveRecord[]
     * @param $tabs bool
     *
     * @return null|string
     */
    public function prepareRows($model, $formConfig, $translationModels, $tabs = false)
    {
        $content = null;
        foreach ($formConfig as $attribute => $element) {
            if (isset($element['class']) && $element['class'] == RelatedFormWidget::className() && is_array($model->relModels)) {
                if ($tabs) {
                    $content .= $this->render('//templates/_related_form', [
                        'class' => $element['class'],
                        'relModels' => $model->relModels[$element['relation']],
                        'form' => $this
                    ]);
                } else {
                    foreach ($model->relModels as $relModels) {
                        $content .= $this->render('//templates/_related_form', [
                            'class' => $element['class'],
                            'relModels' => $relModels,
                            'form' => $this
                        ]);
                    }
                }
            } else {
                $content .= Html::beginTag('div', ['class' => 'row']);
                $content .= Html::beginTag('div', ['class' => 'col-sm-12']);
                $content .= $this->renderField($model, $attribute, $element);
                $content .= $this->renderUploadedFile($model, $attribute, $element);
                if (!empty($translationModels) && $model->isTranslateAttribute($attribute)) {
                    foreach ($translationModels as $languageModel) {
                        $content .= Html::beginTag('div', ['class' => 'row']);
                        $content .= Html::beginTag('div', ['class' => 'col-sm-12']);
                        $content .= $this->renderField($languageModel, '[' . $languageModel->language . ']' . $attribute, $element);
                        $content .= $this->renderUploadedFile($languageModel, $attribute, $element, $languageModel->language);
                        $content .= Html::endTag('div');
                        $content .= Html::endTag('div');
                    }
                }
                $content .= Html::endTag('div');
                $content .= Html::endTag('div');
            }
        }

        return $content;
    }
}
