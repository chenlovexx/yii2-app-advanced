<h1>post/index</h1>

<?php
use yii\widgets\ListView;
echo ListView::widget( [
    'dataProvider' => $listDataProvider,
    'itemView' => '_item',
] ); ?>