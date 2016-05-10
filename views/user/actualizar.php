<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Editar Usuario: "'.$model->username.'"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, rellene los siguientes campos para registrarse:</p>
    
    <div id="mensaje"></div>
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
//                    'id' => 'form-signup',
                    'id' => $model->formName(),
                    'method' => 'post',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                ]); ?>

                <?= $form->field($model, 'email')->textInput() ?>
            
                <?= $form->field($model, 'password_hash')->passwordInput(['value'=>'']) ?>
            
                <?= $form->field($model, 'repetir_password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

$script = <<< JS
        $('form#{$model->formName()}').on('beforeSubmit', function(e){        
            var \$form =$(this);
            $.post(
                \$form.attr("action")+"&submit=true",
                \$form.serialize()
            )
            .done(function(result){
                if(result == 1)
                {                    
                    $(\$form).trigger("reset");
                    $.pjax.reload({container:'#usuarios'});
                    $('#mensaje').html('<div class="alert alert-success" role="alert"><b>¡El usuario se actualizó satisfactoriamente.!</b></div>');
                }
                else
                {                    
                    $('#mensaje').html('<div class="alert alert-danger" role="alert"><b>¡Error!. El usuario no se actualizó satisfactoriamente</b></div>');
                }
            }).fail(function(){
                console.log("ERRORRR");
            });
            return false;
        });
JS;
        $this->registerJs($script);

?>