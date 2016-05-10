<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Usuarios a medias';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?=  Html::a(
                '',
                Url::home(),
                [
                    'class' => 'btn btn-default glyphicon glyphicon-home',
                    'title' => 'Página de Inicio',
                ])?>
        <?=  Html::button(
                '', 
                [
                    'class' => 'btn btn-default glyphicon glyphicon-refresh',
                    'title' => 'Refrescar Página',
                    'onClick' => 'document.location.reload();',
                ])?>
    </p>
    
    <h1 style="text-align: center;"><?= Html::encode($this->title) ?></h1>
    <div id="mensaje1"></div>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::button(
//                '+', 
//                [
//                    'value' => Url::to(['user/signup']),
//                    'class' => 'btn btn-success glyphicon glyphicon-user',
//                    'id' => 'modalButton',
//                    'title' => 'Registrar Usuario',
//                ])?>
        
        <?= Html::a('+', '#', [
            'id' => 'activity-index-link',
            'class' => 'btn btn-success glyphicon glyphicon-user',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['signup']),
            'data-pjax' => '0',
        ]); ?>

        
        <?= Html::a('Roles y Permiso', ['/auth-item'], ['class' => 'btn btn-success']) ?>
    </p>
    
    
    
    
    <?php Pjax::begin([
        'id' => 'usuarios',
        'enablePushState' => false,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status == 0)
            {
                return ['class' => 'danger'];
            }
            else
            {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
             'email:email',
//             'status',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{actualizar}{cambiarestado}',
                'header' => 'Editar Usuario',
                'buttons' => [
                    
                    'actualizar' => function ($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>', 
                                '#', 
                                [
                                    'id' => 'activity-index-link',
                                    'title' => Yii::t('app', 'actualizar'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal',
                                    'data-url' => Url::to(['actualizar', 'id' => $model->id]),
                                    'data-pjax' => '0',
                                ]
                            );
                    },                    
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{actualizar}{cambiarestado}',
                'header' => 'Estado',
                'buttons' => [
                    
                    'cambiarestado' => function($url, $model){
                        if($model->status == 10)
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-ok alert-success"></span>',
                                        '#',
                                        [                                            
                                            'id' => 'cambiarestado',
                                            'title' => Yii::t('app', 'Desactivar'),
                                            'data-url' => Url::to(['cambiarestado', 'id' => $model->id]),
                                            'data-pjax' => '0',
                                        ]
                                    );
                        }
                        else
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-remove alert-danger"></span>',
                                        '#',
                                        [                                            
                                            'id' => 'cambiarestado',
                                            'title' => Yii::t('app', 'Desactivar'),
                                            'data-url' => Url::to(['cambiarestado', 'id' => $model->id]),
                                            'data-pjax' => '0',
                                        ]
                                    );
                        }
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'header' => 'Roles',
                'buttons' => [
                    
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-arrow-right"></span>', 
                                $url, 
                                [
                                    'id' => 'asignar_roles',
                                    'title' => Yii::t('app', 'Asignar Roles'),
                                ]
                            );
                    },                    
                ]
            ],
                        
                        
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>


<?php
$script = <<< JS

$(document).on('click', '#cambiarestado', (function() {
//    alert('ola');
//    return false;
        $.get(
            $(this).data('url'),
            function (data) {
                $.pjax.reload({container:'#usuarios'});
                $('#mensaje1').html(data.message);
            }
        );
    }));

JS;
$this->registerJs($script);
?>


<?php
$this->registerJs(
"$(document).on('click', '#activity-index-link', (function() {
        $.get(
            $(this).data('url'),
            function (data) {
                $('.modal-body').html(data);
                $('#modal').modal();
            }
        );
    }));"
); ?>

<?php
Modal::begin([
    'header' => '<h3>Usuario</h3>',
    'id' => 'modal',
//    'size' => 'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
