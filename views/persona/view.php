<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_tip_doc_iden',
            'num_doc',
            'razon_social',
            'direccion',
            'id_genero',
            'id_est_civil',
            'nombres',
            'paterno',
            'materno',
            'fecha_nac',
            'telefono',
            'celular',
            'correo',
            'fecha_inscripcion',
            'tipo_contrib',
            'estado_contrib',
            'condicion_contrib',
        ],
    ]) ?>

</div>
