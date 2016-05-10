<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

use app\models\AuthAssignment;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <!--<h1><?php // Html::encode($this->title) ?></h1>-->

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
        <?= Html::a(' Usuarios', ['/user'], ['class' => 'btn btn-default glyphicon glyphicon-arrow-left',]) ?>
    </p>
    
    <div id="mensaje1"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h6 class="panel-title" style="text-align: center;"><b><?= $model->username ?></b></h6>
        </div>
        <div class="panel-body">
            <p><b>E-mail: </b><?= $model->email ?></p>
            <p><b>Estado: </b><?= $model->status ?></p>
        </div>
        <?php 
                Pjax::begin([
                'enablePushState' => false,
                'id' => 'roles2',
                ]); ?>
        <div class="table-responsive">
            <table class="table">
                
                <?= GridView::widget([
                'dataProvider' => $user_asignado,
//                'filterModel' => $searchModel,
                'showOnEmpty'=>false,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

        //            'id',
                    'item_name',
        //            'auth_key',
        //            'password_hash',
        //            'password_reset_token',
                     'itemName.description',
        //             'status',
                    // 'created_at',
                    // 'updated_at',

                    


                ],
            ]); ?>
                
                
            </table>
        </div>
        <?php
//                $ventana1->end();
                Pjax::end();
                ?>
    </div>

    <?php Pjax::begin([
        'enablePushState' => false,
        'id' => 'roles',
        ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->type == 2)
            {
                return ['hidden' => true];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
//            'type',
            'description:ntext',
//            'rule_name',
//            'data:ntext',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{asignarrol}',
                'header' => 'Estado',
                'buttons' => [
                    
                    'asignarrol' => function($url, $model){
            
                        $user_rol = AuthAssignment::find()->where('item_name = "'.$model->name.'" and user_id = "'.$this->title.'"')->one();
                        if(!empty($user_rol))
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-minus btn btn-danger btn-xs"></span>',
                                        '#',
                                        [
//                                            'title' => 'Desactivar',
//                                            'class' => 'cambiar_estado',
                                            
                                            'id' => 'asignarrol',
                                            'title' => Yii::t('app', 'Quitar'),
                                            'data-url' => Url::to(['asignarrol', 'id_user' => $this->title, 'rol' => $model->name]),
                                            'data-pjax' => '0',
                                        ]
                                    );
                        }
                        else
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-plus btn btn-success btn-xs"></span>',
                                        '#',
                                        [
//                                            'title' => 'Activar',
//                                            'class' => 'cambiar_estado',
                                            
                                            'id' => 'asignarrol',
                                            'title' => Yii::t('app', 'Asignar'),
                                            'data-url' => Url::to(['asignarrol', 'id_user' => $this->title, 'rol' => $model->name]),
                                            'data-pjax' => '0',
                                        ]
                                    );
                        }
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

<?php
$script = <<< JS

$(document).on('click', '#asignarrol', (function() {
//    alert('ola');
//    return false;
        $.get(
            $(this).data('url'),
            function (data) {
                $.pjax.reload({container:'#roles', async:false});
                $.pjax.reload({container:'#roles2', async:false});
                $('#mensaje1').html(data.message);
            }
        );
    }));

JS;
$this->registerJs($script);
?>