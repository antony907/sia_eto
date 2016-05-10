<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcgeDivisoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcge Divisorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-divisoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcge Divisoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pcgeSubcuenta.codigo',
            'pcgeSubcuenta.descripcion',
            'codigo',
            'descripcion',
//            'pcge_subcuenta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
