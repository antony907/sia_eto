<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PcgeSubcuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcge Subcuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-subcuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcge Subcuenta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pcgeCuenta.codigo',
            'pcgeCuenta.descripcion',
            'codigo',
            'descripcion',
            'pcge_cuenta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
