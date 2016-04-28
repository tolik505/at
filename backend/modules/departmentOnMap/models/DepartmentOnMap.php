<?php

namespace backend\modules\departmentOnMap\models;

use common\helpers\DepartmentOnMapHelper;
use Yii;
use \backend\components\BackendModel;
use metalguardian\formBuilder\ActiveFormBuilder;

/**
 * This is the model class for table "{{%department_on_map}}".
 *
 * @property integer $id
 * @property string $contact_person
 * @property string $contact_address
 * @property string $contact_tel
 * @property string $contact_email
 * @property string $contact_fax
 * @property integer $mark_baloon_type
 * @property string $lat
 * @property string $long
 * @property integer $published
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 */
class DepartmentOnMap extends \common\components\model\ActiveRecord implements BackendModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department_on_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark_baloon_type', 'published', 'position'], 'integer'],
            [['lat', 'long'], 'required'],
            [['contact_person', 'contact_address', 'contact_tel', 'contact_email', 'contact_fax', 'lat', 'long'], 'string', 'max' => 255],
            [['mark_baloon_type'], 'default', 'value' => 0],
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
            'contact_person' => 'Contact Person',
            'contact_address' => 'Contact Address',
            'contact_tel' => 'Contact Tel',
            'contact_email' => 'Contact Email',
            'contact_fax' => 'Contact Fax',
            'mark_baloon_type' => 'Mark Baloon Type',
            'lat' => 'Lat',
            'long' => 'Long',
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
        return \Yii::t('app', 'Department On Map');
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
                    'contact_person',
                    'contact_address',
//                    'contact_tel',
//                    'contact_email:email',
//                    'contact_fax',
                    [
                        'attribute' => 'mark_baloon_type',
                        'filter' => DepartmentOnMapHelper::getBalloonTypeArray(),
                        'format' => 'raw',
                        'value' => function ($data) {

                            return DepartmentOnMapHelper::getBalloonTypeArray()[$data->mark_baloon_type];

                        }
                    ],
                    // 'lat',
                    // 'long',
                    'published:boolean',
                    'position',
                    ['class' => 'yii\grid\ActionColumn'],
                ];
            break;
            case 'view':
                return [
                    'id',
                    'contact_person',
                    'contact_address',
                    'contact_tel',
                    'contact_email:email',
                    'contact_fax',
                    [
                        'attribute' => 'mark_baloon_type',
                        'format' => 'raw',
                        'value' => DepartmentOnMapHelper::getBalloonTypeArray()[$this->mark_baloon_type]
                    ],
                    'lat',
                    'long',
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
        return new DepartmentOnMapSearch();
    }

    /**
    * @return array
    */
    public function getFormConfig()
    {
        return [
            'contact_person' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'contact_address' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'contact_tel' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'contact_email' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'contact_fax' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                    
                ],
            ],
            'mark_baloon_type' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => DepartmentOnMapHelper::getBalloonTypeArray()
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
                'hint' => 'Для заполнения параметров долготы и широты, можно кликнуть правой клавишой мыши по карте ниже!',
                'options' => [
                    'maxlength' => true,
                    'id' => 'coordinates_y'
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
                    'class' => 'test_click'
                ],
            ],
            'position' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
            ],
            
        ];
    }

}
