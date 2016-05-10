<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tip_doc_iden') ?>

    <?= $form->field($model, 'num_doc') ?>

    <?= $form->field($model, 'razon_social') ?>

    <?= $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'id_genero') ?>

    <?php // echo $form->field($model, 'id_est_civil') ?>

    <?php // echo $form->field($model, 'nombres') ?>

    <?php // echo $form->field($model, 'paterno') ?>

    <?php // echo $form->field($model, 'materno') ?>

    <?php // echo $form->field($model, 'fecha_nac') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'celular') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'fecha_inscripcion') ?>

    <?php // echo $form->field($model, 'tipo_contrib') ?>

    <?php // echo $form->field($model, 'estado_contrib') ?>

    <?php // echo $form->field($model, 'condicion_contrib') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
