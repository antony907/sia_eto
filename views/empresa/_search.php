<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'razon_social') ?>

    <?= $form->field($model, 'ruc') ?>

    <?= $form->field($model, 'rubro') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'ciudad') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'regimen') ?>

    <?php // echo $form->field($model, 'anio_ini_contable') ?>

    <?php // echo $form->field($model, 'por_renta') ?>

    <?php // echo $form->field($model, 'por_participa_trab') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
