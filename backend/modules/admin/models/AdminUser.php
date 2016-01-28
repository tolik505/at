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
 * Class AdminUser
 *
 * @property AuthAssignment $authAdmin
 * @property AuthAssignment $authModerator
 */
class AdminUser extends \common\models\AdminUser implements BackendModel
{
    public $newPassword;

    protected $admin;
    protected $moderator;

    /**
     * Get title for the template page
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Admin User');
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
                        'filter' => $this->getStatuses(),
                        'value' => function (AdminUser $data) {
                            return $data->getStatusText($data->status);
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div style="text-align: center;">{checkRoles} {view} {update} {delete}</div>',
                        'buttons' => [
                            'checkRoles' => function ($url, AdminUser $model, $key) {
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
                    [
                        'attribute' => 'status',
                        'value' => $this->getStatusText($this->status),
                    ],
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
        $input = Html::activeRadioList($this, $attribute  . '_check', AdminUser::getList('checkStatus'), [
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
     * @return \yii\db\ActiveRecord
     */
    public function getSearchModel()
    {
        return new AdminUserSearch();
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
            'status' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => $this->getStatuses(),
                'options' => [
                    'prompt' => Yii::t('app', 'Select'),
                ],
            ],
            'newPassword' => [
                'type' => ActiveFormBuilder::INPUT_PASSWORD,
                'options' => [
                    'maxlength' => true,
                ],
                'hint' => $this->isNewRecord ? Yii::t('app', 'Required for user creation') : Yii::t('app', 'Fill only if you want to change password'),
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setAdmin('1');
            }
            $this->auth_key = Yii::$app->security->generateRandomString();
            if (!empty($this->newPassword)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->newPassword);
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole(AdminUser::ROLE_ADMIN);
        if ($this->admin === '1') {
            $auth->assign($admin, $this->id);
        }

    }

    public function beforeDelete()
    {
        $this->setAdmin('0');
        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole(AdminUser::ROLE_ADMIN);
        if ($this->admin === '0') {
            $auth->revoke($admin, $this->id);
        }
    }

    public function getAuthAdmin()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id'])->andWhere(['item_name' => AdminUser::ROLE_ADMIN]);
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
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id'])->andWhere(['item_name' => AdminUser::ROLE_MODERATOR]);
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
        $all = AdminUser::find()
            ->select(['id', 'username', 'email'])
            ->innerJoinWith(['authModerator'])
            ->asArray()
            ->all();

        return ArrayHelper::map($all, 'id', function ($item) {
            return $item['username'] . ' (' . $item['email'] . ')';
        });
    }
}
