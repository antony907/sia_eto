<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?=
Html::a(
        '',
        [
            '/asiento-contable',
        ],
        [
            'class'=>"glyphicon glyphicon-arrow-left btn btn-default",
            'width'=>'200px',
            'title'=>'Atras',
        ]
    )
?>
<?php
$this->title = 'Asiento Contable N° '.$asiento_contable->num_asiento;
?>

<p>
        <?= Html::a('Create Asiento Detalle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="page-header">
  <h1><small>Asiento Contable N° </small><?= $asiento_contable->num_asiento ?></h1>

<h4>
<b>ID: </b><span class="label label-default"><?= $asiento_contable->id ?></span>
<b>Fecha: </b><span class="label label-default"><?= $asiento_contable->fecha ?></span>
<b>Glosa: </b><span class="label label-default"><?= $asiento_contable->glosa ?></span>

</h4>
</div>

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
         'pcge_auxiliar_id',
         'tipo_documento_id',
         'persona_id',
         'asiento_contable_id',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>