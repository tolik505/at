<?php
namespace frontend\controllers;

use common\models\Ingredient;
use common\models\IngredientToRecipe;
use common\models\Recipe;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use common\models\LoginForm;
use frontend\models\ContactForm;
use yii\db\Query;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;

/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['dashboard'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['dashboard'],
            'rules' => [
                [
                    'actions' => ['dashboard'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }

    public function actionDashboard()
    {
        $response = [
            'username' => Yii::$app->user->identity->username,
            'access_token' => Yii::$app->user->identity->getAuthKey(),
        ];

        return $response;
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                $response = [
                    'flash' => [
                        'class' => 'success',
                        'message' => 'Thank you for contacting us. We will respond to you as soon as possible.',
                    ]
                ];
            } else {
                $response = [
                    'flash' => [
                        'class' => 'error',
                        'message' => 'There was an error sending email.',
                    ]
                ];
            }
            return $response;
        } else {
            $model->validate();
            return $model;
        }
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetIngredients()
    {
        return Ingredient::find()
            ->where(['published' => 1])
            ->orderBy('position DESC')
            ->asArray()
            ->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetRecipes()
    {
        $ingredients = Yii::$app->request->post('ingredients');

        $ids = (new Query())
            ->select('recipe_id')
            ->from(IngredientToRecipe::tableName())
            ->where(['not in', 'ingredient_id', $ingredients]);
        $recipes = Recipe::find()
            ->from(['t' => Recipe::tableName()])
            ->joinWith('ingredientToRecipes')
            ->joinWith('titleImage')
            ->where(['ingredient_id' => $ingredients, 't.published' => 1])
            ->andWhere(['not in', 't.id', $ids])
            ->orderBy('t.position DESC')
            ->asArray()
            ->all();

        foreach ($recipes as &$item) {
            if (!empty($item['titleImage'])) {
                $item['titleImage'] = FPM::src($item['titleImage']['file_id'], 'recipe', 'preview');
            }
        }

        return $recipes;
    }
}
