<?php

namespace frontend\controllers;
use frontend\models\Post;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

class PostController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$dataProvider = new ActiveDataProvider([
			'query' => Post::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		$this->view->title = 'Posts List';
        return $this->render('index', ['listDataProvider' => $dataProvider]);
    }
	
	public function actionShow($id){
		if (($model = Post::findOne($id)) !== null) {
			$this->view->title = $model->title;
            return $this->render('detail', [
				'model' => $model,
			]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
       
	}
	
/* 	protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } */
}
