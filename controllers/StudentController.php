<?php

namespace app\controllers;

use app\models\Student;
use app\models\Students;
use app\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * StudentController implements the CRUD actions for Students model.
 */
class StudentController extends Controller
{
    /**
     * @inheritDoc
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Students models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Students();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateStudent()
    {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $student = new Student();
        $value = $student->attributes;

        $student->scenario = Student:: SCENARIO_CREATE;
        $student->attributes = \yii::$app->request->post();
        
       
        if (!\Yii::$app->request->isPost) {
            \Yii::$app->response->statusCode = 406;
            return $this->asJson([
                "status" => \Yii::$app->response->statusCode,
                "description" => "Invalid HTTP Method",
                "data" => [],
            ]);
        }else{
            
        }

        // $data = Yii::$app->request->bodyParams;

        // var_dump($data);
        // die();


            if($student->attributes && $student->validate())
            {
                $student = new Student();
                $data = \Yii::$app->request->getBodyParams();
                $student->Name= $data['Name'];
                $student->Last_Name= $data['Last_Name'];
                $student->Email= $data['Email'];

                // $student->save(false);

                // var_dump($student);
                // die();

                if($student->save(false)){
                    // var_dump($data);
                    // die();
                    return $this->asJson( array('status' => true, 'data'=> 'Student record is successfully updated'));

                }

                
            }
            else
            {
                return $this->asJson(array('status'=>false,'data'=>$student->getErrors()));
            }
                
        // var_dump($student->attributes);
        // die();

    }

    public function actionGetStudent()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $student = Student::find()->all();
        if(count($student) > 0 )
        {
            return array('status' => true, 'data'=> $student);
        }
        else
        {
            return array('status'=>false,'data'=> 'No Student Found');
        }
    }

    public function actionDeleteStudent()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $attributes = \yii::$app->request->post();
        $student = Student::find()->where(['ID' => $attributes['id'] ])->one();
        if(count($student) > 0 )
        {
            $student->delete();
            return array('status' => true, 'data'=> 'Student record is successfully deleted');
        }
        else
        {
            return array('status'=>false,'data'=> 'No Student Found');
        }
    }

}
