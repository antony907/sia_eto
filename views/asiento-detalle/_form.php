<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoDetalle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'glosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'haber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pcge_auxiliar_id')->textInput() ?>

    <?= $form->field($model, 'tipo_documento_id')->textInput() ?>

    <?= $form->field($model, 'persona_id')->textInput() ?>

    <?= $form->field($model, 'asiento_contable_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
