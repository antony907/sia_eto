<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsientoDetalleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asiento Detalles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-detalle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asiento Detalle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'num_doc',
            'fecha',
            'glosa',
            'debe',
            // 'haber',
            // 'pcge_auxiliar_id',
            // 'tipo_documento_id',
            // 'persona_id',
             'asiento_contable_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
