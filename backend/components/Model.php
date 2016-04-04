<?php

namespace backend\components;


use common\components\model\ActiveRecord;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class Model
 *
 * @package backend\components
 */
class Model extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param $post array
     * @param array $multipleModels
     *
     * @return array
     */
    public static function createMultiple($modelClass, $post, $multipleModels = [])
    {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = isset($post[$formName]) ? $post[$formName] : null;
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[$i] = $multipleModels[$item['id']];
                } else {
                    $models[$i] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

    /**
     * @param array $models
     * @param array $data
     * @param string | null $formName
     * @param int | null $index
     *
     * @return bool
     */
    public static function loadMultiple($models, $data, $formName = null, $index = null)
    {
        if ($formName === null) {
            /* @var $first Model */
            $first = reset($models);
            if ($first === false) {
                return false;
            }
            $formName = $first->formName();
        }
        $success = false;
        foreach ($models as $i => $model) {
            if (is_null($index)) {
                $dataIfNoFormName = $data[$index][$i];
                $dataIfIsFormName = $data[$formName][$index][$i];
            } else {
                $dataIfNoFormName = $data[$i];
                $dataIfIsFormName = $data[$formName][$i];
            }
            /* @var $model Model */
            if ($formName == '') {
                if (!empty($dataIfNoFormName)) {
                    $model->load($dataIfNoFormName, '');
                    $success = true;
                }
            } elseif (!empty($dataIfIsFormName)) {

                $model->load($dataIfIsFormName, '');
                $success = true;
            }
        }

        return $success;
    }

    /**
     * @param $model ActiveRecord
     * @param $relModels ActiveRecord[]
     * @param $config array
     * @param $key string
     * @param $deletedIDs array
     * @param $relatedModel string
     * @param $flag bool
     *
     * @throws Exception
     */
    public static function saveRelModels($model, $relModels, $config, $key, $deletedIDs, $relatedModel, &$flag)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($flag = $model->save(false)) {
                if (!empty($deletedIDs)) {
                    $relatedModel::deleteAll(['id' => $deletedIDs]);
                }
                $i = 0;
                foreach ($relModels as $modelRel) {
                    $relatedAttribute = key($model->getRelation($config[$key]['relation'])->link);
                    $modelRel->$relatedAttribute = $model->id;
                    if ($modelRel->hasAttribute('position')) {
                        $modelRel->position = $i++;
                    }
                    if (!($flag = $modelRel->save(false))) {

                        $transaction->rollBack();
                        break;
                    }
                }
            }
            if ($flag) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }
}
