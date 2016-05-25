<?php

namespace backend\modules\recipe\models;

use tolik505\relatedForm\RelatedFormWidget;
use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;
use \common\components\model\Translateable;
use backend\modules\imagesUpload\models\ImagesUploadModel;
use backend\modules\imagesUpload\widgets\imagesUpload\ImageUpload;
use common\models\base\EntityToFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%recipe}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $summary
 * @property string $directions
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RecipeTranslation[] $translations
 */
class Recipe extends \common\components\model\ActiveRecord implements BackendModel, Translateable
{
    use \backend\components\TranslateableTrait;
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
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['summary', 'directions'], 'string'],
            [['published', 'position'], 'integer'],
            [['label'], 'string', 'max' => 255],
            [['published'], 'default', 'value' => 1],
            [['position'], 'default', 'value' => 0],
            [['sign'], 'string', 'max' => 255],
    
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'summary' => 'Summary',
            'directions' => 'Directions',
            'published' => 'Published',
            'position' => 'Position',
        ];
    }

    /**
    * @return array
    */
    public static function getTranslationAttributes()
    {
        return [
            'label',
            'summary',
            'directions',
        ];
    }

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'translateable' => [
                'class' => \creocoder\translateable\TranslateableBehavior::className(),
                'translationAttributes' => static::getTranslationAttributes(),
            ],
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
            'seo' => [
                'class' => \notgosu\yii2\modules\metaTag\components\MetaTagBehavior::className(),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientToRecipes()
    {
        return $this->hasMany(IngredientToRecipe::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(RecipeTranslation::className(), ['model_id' => 'id']);
    }
    /**
    * Get title for the template page
    *
    * @return string
    */
    public function getTitle()
    {
        return \Yii::t('app', 'Recipe');
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
                    // 'id',
                    'label',
                    // 'summary:ntext',
                    // 'directions:ntext',
                    'published:boolean',
                    'position',
                    ['class' => 'yii\grid\ActionColumn'],
                ];
            break;
            case 'view':
                return [
                    'id',
                    'label',
                    [
                        'attribute' => 'summary',
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'directions',
                        'format' => 'html',
                    ],
                    'published:boolean',
                    'position',
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
        return new RecipeSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'form-set' => [
                'Основные' => [
                    'label' => [
                        'type' => ActiveFormBuilder::INPUT_TEXT,
                        'options' => [
                            'maxlength' => true,

                        ],
                    ],
                    'summary' => [
                        'type' => ActiveFormBuilder::INPUT_WIDGET,
                        'widgetClass' => \backend\components\ImperaviContent::className(),
                        'options' => [
                            'model' => $this,
                            'attribute' => 'summary',
                        ]
                    ],
                    'directions' => [
                        'type' => ActiveFormBuilder::INPUT_WIDGET,
                        'widgetClass' => \backend\components\ImperaviContent::className(),
                        'options' => [
                            'model' => $this,
                            'attribute' => 'directions',
                        ]
                    ],
                    'published' => [
                        'type' => ActiveFormBuilder::INPUT_CHECKBOX,
                    ],
                    'position' => [
                        'type' => ActiveFormBuilder::INPUT_TEXT,
                    ],
                    'titleImage' => [
                        'type' => ActiveFormBuilder::INPUT_RAW,
                        'value' => ImageUpload::widget([
                            'model' => $this,
                            'attribute' => 'titleImage',
                            //'saveAttribute' => EntityToFile::TYPE_ARTICLE_TITLE_IMAGE, //TODO Создать контанту и раскомментировать
                            //'aspectRatio' => 300/200, //Пропорция для кропа
                            'multiple' => true, //Вкл/выкл множественную загрузку
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
                ],
                'Ингредиенты' => [
                    [
                        'class' => RelatedFormWidget::className(),
                        'relation' => 'ingredientToRecipes',
                    ]
                ],
            ]
        ];
    }

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
}
