<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcgeSubdivisoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcge Subdivisorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-subdivisoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcge Subdivisoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pcgeDivisoria.codigo',
            'pcgeDivisoria.descripcion',
            'codigo',
            'descripcion',
            'pcge_divisoria_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
