<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?=
Html::a(
        '',
        [
            'index',
        ],
        [
            'class'=>"glyphicon glyphicon-arrow-left btn btn-default",
            'width'=>'200px',
            'title'=>'Atras',
        ]
    )
?>


<br><br>
<?= $model->fecha ?>
<?= $model->glosa ?>
<br><br>
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
         'haber',
        // 'pcge_auxiliar_id',
        // 'tipo_documento_id',
        // 'persona_id',
         'asiento_contable_id',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>