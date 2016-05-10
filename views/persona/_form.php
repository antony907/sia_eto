<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoDocumentoIdentidad;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_tip_doc_iden')->textInput() ?>
    
    <?php 
    $tipo_doc_ident = TipoDocumentoIdentidad::find()->all(); 
    $listData = ArrayHelper::map($tipo_doc_ident, 'id', 'abreviatura');
    echo $form->field($model, 'id_tip_doc_iden')->dropDownList($listData,['prompt'=>'Seleccione un Documento de Identidad']);
    ?>

    <?= $form->field($model, 'num_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_genero')->textInput() ?>

    <?= $form->field($model, 'id_est_civil')->textInput() ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'materno')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'fecha_nac')->textInput() ?>
    
    <?php echo $form->field($model,'fecha_nac')->
    widget(DatePicker::className(),[
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'yearRange' => '-115:+0',
            'changeYear' => true
        ],
        'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inscripcion')->textInput() ?>

    <?= $form->field($model, 'tipo_contrib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_contrib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condicion_contrib')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
