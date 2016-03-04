<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\components;

use backend\modules\configuration\models\Configuration;
use metalguardian\fileProcessor\helpers\FPM;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Class ConfigurationModel
 *
 * @package backend\modules\configuration\models
 */
abstract class ConfigurationModel extends Model
{
    protected $models;

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    abstract public function getKeys();

    public function init()
    {
        parent::init();

        $seo = $this->getBehavior('seo');
        if ($seo && $seo instanceof \notgosu\yii2\modules\metaTag\components\MetaTagBehavior) {
            $this->attachValidator();
        }
    }

    /**
     * Save configuration models
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save()
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        $saved = true;

        $models = $this->getModels();

        foreach ($models as $item) {
            if ($item->type == Configuration::TYPE_FILE) {
                $this->uploadFile($item);
            }

            $saved &= $item->save();
        }

        if (!$saved) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();

        $seo = $this->getBehavior('seo');
        if ($seo && $seo instanceof \notgosu\yii2\modules\metaTag\components\MetaTagBehavior) {
            $modelName = (new \ReflectionClass($this))->getShortName();

            $data = \Yii::$app->request->post($modelName);

            $this->metaTags = ArrayHelper::getValue($data, 'metaTags');

            $this->saveMetaTags();
        }

        return true;
    }

    /**
     * Title of the form
     *
     * @return string
     */
    abstract public function getTitle();

    /**
     * @return Configuration[]
     */
    public function getModels()
    {
        $types = $this->getFormTypes();

        if (null === $this->models) {
            $models = [];
            foreach ($this->getKeys() as $key) {
                $model = Configuration::findOne($key);
                if (!$model) {
                    // create model if it is not created yet
                    $model = new Configuration();
                    $model->id = $key;
                    $model->preload = 0;
                    $model->published = 1;
                }

                $model->type = ArrayHelper::getValue($types, $key, Configuration::TYPE_STRING);

                $models[$key] = $model;
            }

            $this->models = $models;
        }

        $seo = $this->getBehavior('seo');
        if ($seo && $seo instanceof \notgosu\yii2\modules\metaTag\components\MetaTagBehavior) {
            $this->loadMetaTags();
        }

        return $this->models;
    }

    /**
     * Updated method to load configuration language models
     *
     * @inheritdoc
     */
    public static function loadMultiple($models, $data, $formName = null, $key = '')
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
            /* @var $model Model */
            if ($formName == '') {
                if (!empty($data[$i])) {
                    $model->load($data[$i], '');
                    $success = true;
                }
            } elseif (!empty($data[$formName][$i])) {
                $model->load($data[$formName][$i], $key);
                $success = true;
            }
        }

        return $success;
    }

    /**
     * @return array
     */
    public function getFormConfig()
    {
        $config = [];

        $models = $this->getModels();

        foreach ($models as $model) {
            $config["[{$model->id}]value"] = $model->getValueFieldConfig();
        }

        return $config;
    }

    /**
     * @return array
     */
    public function getFormTypes()
    {
        return [];
    }

    /**
     * @return array
     */
    abstract public function getUpdateUrl();

    /**
     * @param Configuration $item
     */
    protected function uploadFile(Configuration &$item)
    {
        $files = UploadedFile::getInstances($item, $item->id);
        $file = ArrayHelper::getValue($files, 0);

        if ($file) {
            $item->value = FPM::transfer()->saveUploadedFile($file);
        }

        foreach ($item->getTranslationModels() as $languageModel) {
            $files = UploadedFile::getInstances($languageModel, $languageModel->language . '[' . $item->id . ']');
            $file = ArrayHelper::getValue($files, 0);

            if ($file) {
                $languageModel->value = (string)FPM::transfer()->saveUploadedFile($file);
            }
        }
    }

    public function getId()
    {
        return 1;
    }

    public function getIsNewRecord()
    {
        return false;
    }
}
