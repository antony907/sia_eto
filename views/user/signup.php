<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\widgets\Pjax;

$this->title = 'Registrar Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, rellene los siguientes campos para registrarse:</p>
    
    <div id="mensaje"></div>

    <?php
 
//    $this->registerJs(
//       '$("document").ready(function(){ 
//            $("#nuevo_usuario").on("pjax:end", function() {
//                alert("finn");
//                return false;
//                $.pjax.reload({container:"#usuarios"});  //Reload GridView
//            });
//        });'
//    );
    ?>
    <div class="row">
        <div class="col-lg-5">
            <?php // Pjax::begin([
//                'id' => 'nuevo_usuario',
//            ]); ?>
            <?php $form = ActiveForm::begin([
//                    'id' => 'form-signup',                    
                    'method' => 'post',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'id' => $model->formName(),
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
            
                <?= $form->field($model, 'repetir_password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <?php // Pjax::end() ?>
        </div>
    </div>
</div>

<?php

$script = <<< JS
        $('form#{$model->formName()}').on('beforeSubmit', function(e){        
            var \$form =$(this);
            $.post(
                \$form.attr("action")+"?submit=true",
                \$form.serialize()
            )
            .done(function(result){
                if(result == 1)
                {                    
                    $(\$form).trigger("reset");
                    $.pjax.reload({container:'#usuarios'});
                    $('#mensaje').html('<div class="alert alert-success" role="alert"><b>¡El usuario se creó satisfactoriamente.!</b></div>');
                }
                else
                {                    
                    $('#mensaje').html('<div class="alert alert-danger" role="alert"><b>¡Error!. El usuario no se creo satisfactoriamente</b></div>');
                }
            }).fail(function(){
                console.log("ERRORRR");
            });
            return false;
        });
JS;
        $this->registerJs($script);

?>
