<?php
/**
 * This is the template for generating the model class of a specified table.
 */
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */
/* @var $multiLanguageModel */
/* @var $translationModel boolean */
/* @var $behaviors string[] list of behaviors */
/* @var $translationAttributes string[] list of translated attributes */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;
<?php if ($multiLanguageModel) { ?>
use \common\components\model\Translateable;
<?php } ?>
<?php if ($generator->isImage) : ?>
use backend\modules\imagesUpload\models\ImagesUploadModel;
use backend\modules\imagesUpload\widgets\imagesUpload\ImageUpload;
use common\models\base\EntityToFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
<?php endif; ?>

/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\'); ?> implements BackendModel<?= $multiLanguageModel ? ', Translateable' : null ?><?= "\n" ?>
{
<?php if ($multiLanguageModel) : ?>
    use \backend\components\TranslateableTrait;
<?php endif; ?>
<?php if ($generator->isImage) : ?>
    public $titleImage;

    /**
    * Temporary sign which used for saving images before model save
    * @var
    */
    public $sign;

    public function init()
    {
        parent::init();

        if (!$this->sign) {
            $this->sign = \Yii::$app->security->generateRandomString();
        }
    }
    
<?php endif; ?>
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [<?= "\n            " . implode(",\n            ", $rules) . ",\n        " ?>
<?php if ($generator->isImage): ?>
    [['sign'], 'string', 'max' => 255],
<?php endif; ?>
    
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . $generator->generateStringWithTable($tableSchema, $label) . ",\n" ?>
<?php endforeach; ?>
        ];
    }

<?php if ($multiLanguageModel) : ?>
    /**
    * @return array
    */
    public static function getTranslationAttributes()
    {
        return [
      <?php foreach ($translationAttributes as $attribute): ?>
      <?= "'$attribute',\n" ?>
      <?php endforeach; ?>
  ];
    }

<?php endif; ?>
<?php if (is_array($behaviors) && !empty($behaviors)) : ?>
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [<?= "\n            " . implode(",\n            ", $behaviors) . ",\n        " ?>];
    }
<?php endif; ?>
<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
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
<?php if ($generator->isImage) : ?>'titleImage' => [
                'type' => ActiveFormBuilder::INPUT_RAW,
                'value' => ImageUpload::widget([
                    'model' => $this,
                    'attribute' => 'titleImage',
                    //'saveAttribute' => EntityToFile::TYPE_ARTICLE_TITLE_IMAGE, //TODO Создать контанту и раскомментировать
                    //'aspectRatio' => 300/200, //Пропорция для кропа
                    'multiple' => false, //Вкл/выкл множественную загрузку
                    'uploadUrl' => ImagesUploadModel::uploadUrl([
                        'model_name' => static::className(),
                        'attribute' => 'titleImage',
                        //'entity_attribute' => EntityToFile::TYPE_ARTICLE_TITLE_IMAGE, //TODO Раскомментировать и вписать константу, что сверху
                    ]),
                ])
            ],
            'sign' => [
                'type' => ActiveFormBuilder::INPUT_HIDDEN,
                'label' => false,
            ],
<?php endif; ?>

        ];
    }

<?php if ($generator->isImage) { ?>
    /**
    * @inheritdoc
    */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        EntityToFile::updateImages($this->id, $this->sign);
    }

    /**
    * @inheritdoc
    */
    public function afterDelete()
    {
        parent::afterDelete();

        EntityToFile::deleteImages($this->formName(), $this->id);
    }
<?php } ?>
}
