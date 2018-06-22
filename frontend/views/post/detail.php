<?php
use yii\widgets\DetailView;
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
	    'id',
        'title',                                           // title attribute (in plain text)
        'body'                           // creation date formatted as datetime
    ],
]);