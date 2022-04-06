<?php

namespace app\controllers;

use app\models\SignupForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\TestComponent;
use app\models\Form;

use app\controllers\ConnectException;
use app\controllers\RequestException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionApi()
    {
        // $date   = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        // $month = Yii::$app->mdaUtils->splitDate($date);
        // $month = $month[1];

        // try {

        //     $accessToken = Yii::$app->mdaUtils->getAccessToken();
        //     $headers = ['Authorization' => 'Bearer '. $accessToken, 'Accept' => 'application/json'];

        //     $monthlyRequest =   Yii::$app->mdaUtils->getNewClient()->get(Yii::$app->params["mdaTransactionsByMonthlyRequestUrl"], [
        //         'verify' => false,
        //         'query' => ['mda-id' => $mdaId, 'month' => $month],
        //         'headers' => $headers,
        //     ]);
        //     $monthlyResponse = (object)json_decode($monthlyRequest->getBody()->getContents());
        //     $response        = $monthlyResponse->data;
        //     return $response;

        // } catch (ConnectException $e) {
        //     // Connection exceptions are not caught by RequestException
        //     Yii::error("Internet, DNS, or other connection error\n" . $e->getMessage());
        // }
        // catch (RequestException $e) {

        //     Yii::error("error while fetching MonthlyRequest" . $e->getMessage());
        // }

        return $this->render('api');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $data = Yii::$app->testComponent->verifyTest();

        $dataProvider = new  ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['postId', 'id', 'name', 'email', 'body']
            ],
        ]);

        // var_dump($dataProvider);exit();

        return $this->render('about',['dataProvider' => $dataProvider]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if($model->load(Yii::$app->request->post()) && $model->signup()){
            return $this->redirect(Yii::$app->homeUrl);
        }

        return $this->render("signup",[
            'model' => $model
        ]);

    }

}
