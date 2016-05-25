<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 02.04.16
 * Time: 23:45
 */

namespace backend\components;

use common\components\model\ActiveRecord;
use common\components\model\Translateable;
use metalguardian\fileProcessor\behaviors\UploadBehavior;
use tolik505\relatedform\RelatedFormWidget;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class RelatedFormTrait
 *
 * @package backend\components
 */
trait RelatedFormTrait
{
    /**
     * Action for RelatedFormWidget
     *
     * @param $model ActiveRecord
     * @param $config array
     *
     * @return array|string|Response
     * @throws Exception
     */
    public function relatedFormAction($model, $config)
    {
        /** @var ActiveRecord[][] $relModelsArray */
        $relModelsArray = $model->relModels;
        $model->relModels = [];
        $valid = true;
        $flag = false;
        foreach ($relModelsArray as $key => $relModels) {
            $relatedModel = $relModels[0];
            $relatedModelClassName = $relatedModel::className();
            $deletedIDs = [];
            if ($this->loadModels($model)) {

                $oldIDs = ArrayHelper::map($relModels, 'id', 'id');

                $relModels = Model::createMultiple($relatedModelClassName, Yii::$app->request->post(), $relModels);
                $this->loadMultipleModels($relModels);
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($relModels, 'id', 'id')));
                $this->attachUploadBehavior($config, $key, $relModels);
                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($relModels),
                        ActiveForm::validate($model)
                    );
                }
                // validate all models
                $valid = $model->validate() && $valid;
                $valid = Model::validateMultiple($relModels) && $valid;
                if ($valid) {
                    Model::saveRelModels($model, $relModels, $config, $key, $deletedIDs, $relatedModel, $flag);
                }
                if (!empty($deletedIDs)) {
                    $relModels = ArrayHelper::merge($relModels, [new $relatedModelClassName]);
                }
            }
            if (empty($deletedIDs) && !$relatedModel->isNewRecord) {
                $relModels = ArrayHelper::merge($relModels, [new $relatedModelClassName]);
            }

            $model->relModels[$key] = $relModels;
            foreach ($relModels as $index => $item) {
                $item->relModelIndex = $index;
            }
        }
        $view = '//templates/update';
        $message = 'Record successfully updated!';
        if ($model->isNewRecord) {
            $view = '//templates/create';
            $message = 'Record successfully created!';
        }
        if ($flag && $valid) {
            \Yii::$app->getSession()->setFlash('info', Yii::t('app', $message));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render($view, [
            'model' => $model
        ]);
    }

    /**
     * @param $config array
     * @param $key string
     * @param $relModels ActiveRecord[]
     */
    public function attachUploadBehavior($config, $key, &$relModels)
    {
        if (isset($config[$key]['uploadBehavior'])) {
            foreach ($config[$key]['uploadBehavior'] as $behavior) {
                foreach ($relModels as $index => $modelRel) {
                    $modelRel->attachBehaviors([
                        $behavior['attribute'] => [
                            'class' => UploadBehavior::className(),
                            'attribute' => "[$index]" . $behavior['attribute'],
                            'validator' => [
                                'extensions' => $behavior['extensions'],
                            ],
                            'required' => $behavior['required'],
                        ],
                    ]);
                    if ($modelRel instanceof Translateable && $modelRel->isTranslateAttribute($behavior['attribute'])) {
                        foreach ($modelRel->translations as $langModel) {
                            $langModel->attachBehaviors([
                                $behavior['attribute'] => [
                                    'class' => UploadBehavior::className(),
                                    'attribute' => "[$index][$langModel->language]" . $behavior['attribute'],
                                    'validator' => [
                                        'extensions' => $behavior['extensions'],
                                    ],
                                    'required' => false,
                                ],
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $model ActiveRecord
     *
     * @return array
     */
    public function getRelatedFormActionConfig($model)
    {
        $formConfig = $model->getFormConfig();
        $configArray = [];
        if (isset($formConfig['form-set'])) {
            foreach ($formConfig['form-set'] as $tabConfig) {
                $config = $this->getConfigArray($model, $tabConfig);
                if (!empty($config)) {
                    $configArray = ArrayHelper::merge($configArray, $config);
                }
            }
        } else {
            $configArray = $this->getConfigArray($model, $formConfig);
        }

        return $configArray;
    }

    /**
     * @param $model ActiveRecord
     * @param $formConfig array
     *
     * @return array
     */
    public function getConfigArray($model, $formConfig)
    {
        $return = [];
        foreach ($formConfig as $element) {
            if (isset($element['class']) && $element['class'] == RelatedFormWidget::className()) {
                $relation = $element['relation'];
                $className = $model->getRelation($relation)->modelClass;
                $model->relModels[$relation] = empty($model->$relation) ? [new $className] : $model->$relation;
                $return[$relation] = $element;
            }
        }

        return $return;
    }

    /**
     * Action for RelatedFormWidget, generates new form row
     *
     * @return string
     */
    public function actionGetNewRow()
    {
        $request = Yii::$app->request;
        $className = $request->post('className');
        $container = $request->post('container');
        $index = $request->post('index');
        $relModels[$index] = new $className;
        $relModels[$index]->relModelIndex = $index;

        return Json::encode([
            'replaces' => [
                [
                    'what' => ".$container .content-append:last-child",
                    'data' => $this->renderAjax('//templates/_related_form_fields', ['relModels' => $relModels]),
                ]
            ],
            'js' => Html::script('customSelect2()')
        ]);
    }
}
