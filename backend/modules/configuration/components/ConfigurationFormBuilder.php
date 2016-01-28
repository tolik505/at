<?php
/**
 * Author: hanterrian
 */

namespace backend\modules\configuration\components;

use backend\components\Formatter;
use backend\components\FormBuilder;
use metalguardian\fileProcessor\helpers\FPM;
use yii\bootstrap\Html;

/**
 * Class ConfigurationFormBuilder
 *
 * @package backend\modules\configuration\components
 */
class ConfigurationFormBuilder extends FormBuilder
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
}
