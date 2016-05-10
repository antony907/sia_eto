<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = ($model->tipo == 1)? 'Nuevo Rol':'Nuevo Permiso';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div id="mensaje"></div>

    <p>Por favor, rellene los siguientes campos:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
//                    'id' => 'rolesypermisos',
                    'id' => $model->formName(),
                    'method' => 'post',
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => true,
                ]); ?>

                <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>
            
                <?= $form->field($model, 'descripcion')->textInput() ?>

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
                if(result.tipo == 1)
                {
                    $.pjax.reload({container:'#roles'});
                }
                else
                {
                    $.pjax.reload({container:'#permisos'});
                }                
                $('#mensaje').html(result.message);
                
            }).fail(function(){
                console.log("ERRORRR");
            });
            return false;
        });
JS;
        $this->registerJs($script);

?>