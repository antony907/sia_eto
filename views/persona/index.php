<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Persona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_tip_doc_iden',
            'num_doc',
            'razon_social',
            'direccion',
            // 'id_genero',
            // 'id_est_civil',
            // 'nombres',
            // 'paterno',
            // 'materno',
            // 'fecha_nac',
            // 'telefono',
            // 'celular',
            // 'correo',
            // 'fecha_inscripcion',
            // 'tipo_contrib',
            // 'estado_contrib',
            // 'condicion_contrib',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
