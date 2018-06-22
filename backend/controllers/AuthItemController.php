<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use backend\models\AuthItemSearch;
use backend\models\AuthRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
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
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $current_time = time();
		//print_r($_POST);exit();
/* if(Yii::$app->request->post('AuthItem')['rule_name'] == ''){
	unset(Yii::$app->request->post('AuthItem')['rule_name']);
}
print_r(Yii::$app->request->post('AuthItem'));exit; */
        
        $rules = AuthRule::find()
            ->select(['name'])
            ->indexBy('name')
            ->column();
        
        if ($model->load(Yii::$app->request->post())){
			if($model->rule_name == '') $model->rule_name = null;
			if($model->data == '') $model->data = null;
                        $model->created_at = $current_time;
                        $model->updated_at = $current_time;
			if ($model->save()) {
				return $this->redirect(['view', 'id' => $model->name]);
            }
		}
        return $this->render('create', [
            'model' => $model,
            'rules' => $rules,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_time = time();
        $rules = AuthRule::find()
            ->select(['name'])
            ->indexBy('name')
            ->column();
        if ($model->load(Yii::$app->request->post())){ 
			if($model->rule_name == '') $model->rule_name = null;
			if($model->data == '') $model->data = null;
                        $model->updated_at = $current_time;
			if($model->save()) {
				return $this->redirect(['view', 'id' => $model->name]);
                        }
		}

        return $this->render('update', [
            'model' => $model,
            'rules' => $rules,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
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
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
