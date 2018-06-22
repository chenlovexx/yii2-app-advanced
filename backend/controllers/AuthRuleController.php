<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthRule;
use backend\models\AuthRuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * AuthRuleController implements the CRUD actions for AuthRule model.
 */
class AuthRuleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
		'class' => AccessControl::className(),
		'rules' => [
                    [
			'allow' => true,
			'actions' => [],
			'roles' => ['manageAuth', 'admin'],
                    ],
		],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthRule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthRule model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthRule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthRule();
        $current_time = time();
        if ($model->load(Yii::$app->request->post())) {
           // $rule_path = 'common\rbac\\'. substr($model->name, 2). 'Rule';
        
           // $model->data = 'O:'.strlen($rule_path).':"'. $rule_path . '":3:{s:4:"name";s:'.strlen($model->name).':"'.$model->name.'";s:9:"createdAt";i:'.$current_time.';s:9:"updatedAt";i:'.$current_time.';}';
            //$model->created_at = $current_time;
            //$model->updated_at =  $current_time;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->name]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthRule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_time = time();
        if ($model->load(Yii::$app->request->post())) {
           // $model->updated_at =  $current_time;
           // $rule_path = 'common\rbac\\'.substr($model->name, 2).'Rule';
        
           // $model->data = 'O:'.strlen($rule_path).':"'.$rule_path.'":3:{s:4:"name";s:'.strlen($model->name).':"'.$model->name.'";s:9:"createdAt";i:'.$model->created_at.';s:9:"updatedAt";i:'.$current_time.';}';
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->name]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthRule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthRule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthRule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthRule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
