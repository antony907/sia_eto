<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcgeAuxiliarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcge Auxiliars';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::a('Elemento',['/pcge-elemento'], ['class'=>'btn btn-primary']) ?>
&nbsp;
<?= Html::a('Cuenta',['/pcge-cuenta'], ['class'=>'btn btn-primary']) ?>
&nbsp;
<?= Html::a('Sub Cuenta',['/pcge-subcuenta'], ['class'=>'btn btn-primary']) ?>
&nbsp;
<?= Html::a('Divisoria',['/pcge-divisoria'], ['class'=>'btn btn-primary']) ?>
&nbsp;
<?= Html::a('Sub Divisoria',['/pcge-subdivisoria'], ['class'=>'btn btn-primary']) ?>
<div class="pcge-auxiliar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcge Auxiliar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pcgeSubdivisoria.codigo',
            'pcgeSubdivisoria.descripcion',
            'codigo',
            'descripcion',
//            'pcge_subdivisoria_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
