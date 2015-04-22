<?php
/**
 * This is the template for generating the model class of a specified table.
 */
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \backend\components\gii\crud\Generator */
/* @var $viewColumns array */
/* @var $indexColumns */
/* @var $formColumns */

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->modelClass, '\\')) ?>;

use backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;

/**
 * Class <?= StringHelper::basename($generator->modelClass) . "\n" ?>
 */
class <?= $modelClass ?> extends <?= '\\' . ltrim($generator->baseModelClass, '\\') ?> implements BackendModel
{

    /**
     * Get title for the template page
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>');
    }

    /**
     * Has search form on index template page
     *
     * @return bool
     */
    public function hasSearch()
    {
        return false;
    }

    /**
     * Get attribute columns for index and view page
     *
     * @param $page
     *
     * @return array
     */
    public function getColumns($page)
    {
        switch ($page) {
            case 'index':
                return [
                    ['class' => 'yii\grid\SerialColumn'],

                    <?= implode(",\n                    ", $indexColumns) . ",\n" ?>

                    ['class' => 'yii\grid\ActionColumn'],
                ];
                break;
            case 'view':
                return [
                    <?= implode(",\n                    ", $viewColumns) . ",\n" ?>
                ];
                break;
        }
        return [];
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getSearchModel()
    {
        return new <?= StringHelper::basename($generator->modelClass) ?>Search();
    }

    /**
     * @return array
     */
    public function getFormConfig()
    {
        return [
<?php foreach ($formColumns as $attribute => $config) : ?>
            '<?= $attribute ?>' => <?= $config ?>,
<?php endforeach; ?>
        ];
    }
}
