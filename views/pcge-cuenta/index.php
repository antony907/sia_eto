<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcgeCuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcge Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-cuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcge Cuenta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pcgeElemento.codigo',
            'pcgeElemento.descripcion',
            'codigo',
            'descripcion',
//            'pcge_elemento_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
