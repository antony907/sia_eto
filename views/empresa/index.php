<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Empresa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'razon_social',
            'ruc',
            'rubro',
            'telefono',
            // 'direccion',
            // 'ciudad',
            // 'email:email',
            // 'regimen',
            // 'anio_ini_contable',
            // 'por_renta',
            // 'por_participa_trab',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
