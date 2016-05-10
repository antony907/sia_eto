<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoContable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-contable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'anio')->textInput() ?>

    <?= $form->field($model, 'mes')->textInput() ?>

    <?php //$form->field($model, 'fecha')->textInput() ?>
    
    <?php echo $form->field($model,'fecha')->
    widget(DatePicker::className(),[
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'yearRange' => '-115:+0',
            'changeYear' => true
        ],
        'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ]) ?>

    <?= $form->field($model, 'glosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_asiento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
