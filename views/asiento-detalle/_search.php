<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoDetalleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-detalle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'num_doc') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'glosa') ?>

    <?= $form->field($model, 'debe') ?>

    <?php // echo $form->field($model, 'haber') ?>

    <?php // echo $form->field($model, 'pcge_auxiliar_id') ?>

    <?php // echo $form->field($model, 'tipo_documento_id') ?>

    <?php // echo $form->field($model, 'persona_id') ?>

    <?php // echo $form->field($model, 'asiento_contable_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
