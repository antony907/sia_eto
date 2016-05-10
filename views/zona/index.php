<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zonas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Zona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'nombre',
            'abreviatura',
            'empresa_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
