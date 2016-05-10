<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsientoContableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-contable-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Asiento Contable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'anio',
//            'mes',
            'num_asiento',
            'glosa',
            'fecha',
             

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{ver}',
                'buttons' => [
                    'ver' => function($url, $model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-arrow-right"></span>',
                            [
                                '/asiento-detalle/ver',
                                'id'=>$model->id
                            ],
                            [
                                'title'=>'Ver',
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>
</div>
