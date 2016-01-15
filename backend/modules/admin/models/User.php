<?php

namespace backend\modules\admin\models;

use backend\components\BackendModel;
use common\models\AuthAssignment;
use metalguardian\formBuilder\ActiveFormBuilder;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;

/**
 * Class User
 *
 * @property AuthAssignment $authAdmin
 * @property AuthAssignment $authModerator
 */
class User extends \common\models\User implements BackendModel
{
    protected $admin;
    protected $moderator;

    /**
     * Get title for the template page
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'User');
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
                    [
                        'attribute' => 'id',
                        'headerOptions' => [
                            'width' => '30px',
                        ],
                    ],
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'filter' => static::getList('status'),
                        'value' => function (User $data) {
                            return $data->getListValue('status');
                        },
                    ],
                    [
                        'attribute' => 'type_id',
                        'filter' => static::getList('type_id'),
                        'value' => function (User $data) {
                            return $data->getListValue('type_id');
                        },
                    ],

                    [
                        'class' => \backend\components\CheckboxActionColumn::className(),
                        'attribute' => 'admin',
                        'header' => 'Admin',
                    ],

                    [
                        'class' => \backend\components\CheckboxActionColumn::className(),
                        'attribute' => 'moderator',
                        'header' => 'Moderator',
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div style="text-align: center;">{checkRoles} {view} {update} {delete}</div>',
                        'buttons' => [
                            'checkRoles' => function ($url, User $model, $key) {
                                $options = [
                                    'title' => Yii::t('yii', 'View Roles'),
                                    'aria-label' => Yii::t('yii', 'View Roles'),
                                    'data-pjax' => 0,
                                ];
                                if (empty($model->questionnaireAnswerModeratorAssigns) && empty($model->projectModeratorAssigns)) {
                                    return null;
                                }
                                return Html::a('<span class="glyphicon glyphicon-list"></span>', ['role', 'id' => $model->id], $options);
                            },
                        ],
                        'headerOptions' => [
                            'class' => 'col-xs-1',
                        ],
                    ],

                    // 'email:email',
                    // 'image_id',
                    // 'fb_link:url',
                    // 'vk_link:url',
                    // 'tw_link:url',
                    // 'subscribe:boolean',
                    // 'status',
                    // 'send_new_project:boolean',
                    // 'send_partnership:boolean',
                    // 'send_investing:boolean',
                    // 'send_abuse:boolean',
                    // 'type_id',
                    // 'email_confirm_token:email',
                    // 'fio',
                    // 'address:ntext',
                    // 'nationality',
                    // 'web_site',
                    // 'skype',
                    // 'mobile_telephone',
                    // 'telephone',
                    // 'other_social:ntext',
                    // 'address_check:boolean',
                    // 'current_address_check:boolean',
                    // 'nationality_check:boolean',
                    // 'passport_check:boolean',
                    // 'identification_number_check:boolean',
                    // 'mobile_telephone_check:boolean',
                    // 'referral_count',
                    // 'contact_name',
                    // 'legal_address',
                    // 'jurisdiction',
                    // 'bank_account',
                    // 'identification_number_organization',
                    // 'contact_name_check:boolean',
                    // 'legal_address_check:boolean',
                    // 'fio_check:boolean',
                    // 'jurisdiction_check:boolean',
                    // 'bank_account_check:boolean',
                    // 'identification_number_organization_check:boolean',
                ];
                break;
            case 'index-confirm':
                return [
                    [
                        'attribute' => 'id',
                        'headerOptions' => [
                            'width' => '30px',
                        ],
                    ],
                    'fio',
                    'address',
                    'nationality',
//                    'mobile_telephone',
//                    'contact_name',
//                    'legal_address',
//                    'jurisdiction',
//                    'identification_number_organization',
//                    'bank_account',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div style="text-align: center;">{view}</div>',
                        'headerOptions' => [
                            'class' => 'col-sm-1',
                        ],
                    ],
                ];
                break;
            case 'view':
                return [
                    'id',
                    'username',
                    'email:email',
                    'image_id:iimage',
                    'fb_link:url',
                    'vk_link:url',
                    'tw_link:url',
                    'subscribe:boolean',
                    [
                        'attribute' => 'status',
                        'value' => $this->getListValue('status'),
                    ],
                    /*'send_new_project:boolean',
                    'send_partnership:boolean',
                    'send_investing:boolean',
                    'send_abuse:boolean',*/
                    [
                        'attribute' => 'type_id',
                        'value' => $this->getListValue('type_id'),
                    ],
                    $this->generateCheckViewAttribute('fio'),
                    $this->generateCheckViewAttribute('address'),
                    $this->generateCheckViewAttribute('nationality'),
                    [
                        'label' => \help\t('Confidential files'),
                        'value' => $this->getFiles(),
                        'format' => 'raw',
                    ],
                    'web_site',
                    'skype',
                    $this->generateCheckViewAttribute('mobile_telephone'),
                    'telephone',
                    'other_social:ntext',
                    'referral_count',
                    $this->generateCheckViewAttribute('contact_name'),
                    $this->generateCheckViewAttribute('legal_address'),
                    $this->generateCheckViewAttribute('jurisdiction'),
                    $this->generateCheckViewAttribute('bank_account'),
                    $this->generateCheckViewAttribute('identification_number_organization'),
                ];
                break;
        }
        return [];
    }

    /**
     * @param $attribute
     * @param bool $onlyInput
     * @return mixed
     */
    public function generateCheckViewAttribute($attribute, $onlyInput = false)
    {
        $input = Html::activeRadioList($this, $attribute  . '_check', User::getList('checkStatus'), [
            'id' => $attribute . '-change-check',
            'item' => function ($index, $label, $name, $checked, $value) use ($attribute) {
                return Html::radio($name, $checked, [
                    'value' => $value,
                    'label' => Html::encode($label),
                    'data' => [
                        'href' => Url::to([
                            'change2',
                            'id' => $this->getPrimaryKey(true),
                            'attribute' => $attribute  . '_check',
                            'value' => $value,
                            'key' => '#' . $attribute . '-change-check',
                            'baseAttribute' => $attribute,
                        ]),
                        'ajax' => true,
                    ],
                ]);
            },
        ]);

        if ($onlyInput) {
            return $input;
        }

        return [
            'attribute' => $attribute,
            'value' => Yii::$app->formatter->format($this->{$attribute}, 'ntext') . $input,
            'format' => 'raw',
        ];
    }

    /**
     * @return string
     */
    public function getFiles()
    {
        $files = [];

        foreach ($this->userFiles as $i => $one) {
            $files[] = \help\a(\help\t('Confidential File #') . ($i + 1), $one->getAdminPageUrl(), ['target' => '_blank']);
        }

        return implode('<br>', $files);
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getSearchModel()
    {
        return new UserSearch();
    }

    /**
     * @return array
     */
    public function getFormConfig()
    {
        return [
            'username' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'email' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'fb_link' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'vk_link' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'tw_link' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'subscribe' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'status' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => static::getList('status'),
                'options' => [
                    'prompt' => Yii::t('app', 'Select'),
                ],
            ],
            /*'send_new_project' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'send_partnership' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'send_investing' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],
            'send_abuse' => [
                'type' => ActiveFormBuilder::INPUT_CHECKBOX,
            ],*/
            'type_id' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => static::getList('type_id'),
                'options' => [
                    'prompt' => Yii::t('app', 'Select'),
                    'disabled' => true,
                ],
            ],
            'fio' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'address' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 6,
                ],
            ],
            'nationality' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'web_site' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'skype' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'mobile_telephone' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'telephone' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'other_social' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                'options' => [
                    'rows' => 6,
                ],
            ],
            'contact_name' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'legal_address' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'jurisdiction' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'bank_account' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'identification_number_organization' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
            ],
            'password' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
                'options' => [
                    'maxlength' => true,
                ],
                'hint' => $this->isNewRecord ? Yii::t('app', 'Required for user creation') : Yii::t('app', 'Fill only if you want to change password'),
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $auth = Yii::$app->authManager;
        if (!$auth->checkAccess($this->id, User::ROLE_USER)) {
            $userRole = $auth->getRole(User::ROLE_USER);
            $auth->assign($userRole, $this->id);
        }

        $admin = $auth->getRole(User::ROLE_ADMIN);
        if ($this->admin === '0') {
            if ($this->id !== Yii::$app->user->getId()) {
                $auth->revoke($admin, $this->id);
            }
        } elseif ($this->admin === '1') {
            $auth->assign($admin, $this->id);
        }

        $moderator = $auth->getRole(User::ROLE_MODERATOR);
        if ($this->moderator === '0') {
            $auth->revoke($moderator, $this->id);
        } elseif ($this->moderator === '1') {
            $auth->assign($moderator, $this->id);
        }
    }

    public function getAuthAdmin()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id'])->andWhere(['item_name' => User::ROLE_ADMIN]);
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return !!$this->authAdmin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function getAuthModerator()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id'])->andWhere(['item_name' => User::ROLE_MODERATOR]);
    }

    /**
     * @return mixed
     */
    public function getModerator()
    {
        return !!$this->authModerator;
    }

    /**
     * @param mixed $moderator
     */
    public function setModerator($moderator)
    {
        $this->moderator = $moderator;
    }

    public static function getModeratorList()
    {
        $all = User::find()
            ->select(['id', 'username', 'email'])
            ->innerJoinWith(['authModerator'])
            ->asArray()
            ->all();

        return ArrayHelper::map($all, 'id', function ($item) {
            return $item['username'] . ' (' . $item['email'] . ')';
        });
    }
}
