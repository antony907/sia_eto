<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoContableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-contable-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'anio') ?>

    <?= $form->field($model, 'mes') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'glosa') ?>

    <?php // echo $form->field($model, 'num_asiento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
