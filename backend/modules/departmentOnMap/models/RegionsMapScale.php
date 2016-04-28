<?php

namespace backend\modules\departmentOnMap\models;

use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;

/**
 * This is the model class for table "{{%regions_map_scale}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $lat
 * @property string $long
 * @property string $scale
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 */
class RegionsMapScale extends \common\components\model\ActiveRecord implements BackendModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%regions_map_scale}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'lat', 'long', 'scale'], 'required'],
            [['published', 'position'], 'integer'],
            [['label', 'lat', 'long', 'scale'], 'string', 'max' => 255],
            [['published'], 'default', 'value' => 1],
            [['position'], 'default', 'value' => 0],
            
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
            'lat' => 'Lat',
            'long' => 'Long',
            'scale' => 'Scale',
            'published' => 'Published',
            'position' => 'Position',
        ];
    }

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }
    /**
    * Get title for the template page
    *
    * @return string
    */
    public function getTitle()
    {
        return \Yii::t('app', 'Regions Map Scale');
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
                    'lat',
                    'long',
                    'scale',
                    'published:boolean',
                    'position',
                    ['class' => 'yii\grid\ActionColumn'],
                ];
            break;
            case 'view':
                return [
                    'id',
                    'label',
                    'lat',
                    'long',
                    'scale',
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
        return new RegionsMapScaleSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'label' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'lat' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    'id' => 'coordinates_x'
                ],
            ],
            'long' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    'id' => 'coordinates_y'
                ],
            ],
            'scale' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'hint' => 'Для заполнения параметров долготы, широты и увеличения, можно изменить карту ниже (с помощью манипулятора ПК - "мышь") до нужного результата!',
                'options' => [
                    'maxlength' => true,
                    'id' => 'scale'
                    
                ],
            ],
            [
                'label' => false,
                'type' => ActiveFormBuilder::INPUT_RAW,
                'value' => '<div class="hideme" id="map"></div>'
            ],
            'published' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
                'options' => [
                    'maxlength' => true,
                    'class' => 'test_click'
                ],
            ],
            'position' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,

            ],
            
        ];
    }

}
