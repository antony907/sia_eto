<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles y Permisos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

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
                    'value' => Url::to(['user/signup']),
                    'class' => 'btn btn-default glyphicon glyphicon-refresh',
                    'title' => 'Refrescar Página',
                    'onClick' => 'document.location.reload();',
                ])?>
        
        <?= Html::a(' Usuarios', ['/user'], ['class' => 'btn btn-default glyphicon glyphicon-arrow-left',]) ?>
    </p>
    <h1 style="text-align: center;"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div style="width: 50%; float: left; padding-right: 10px;">
    <h3>ROLES</h3>
    
    <p>
        
        <?= Html::a('Nuevo Rol', '#', [
            'class' => 'btn btn-success rolesypermisos',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['nuevo', 'id' => 1]),
            'data-pjax' => '0',
        ]); ?>
    </p>
    
    <?php Pjax::begin([
        'enablePushState' => false,
        'id' => 'roles',
        ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
//        'filterModel' => $searchModel,
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
                'template' => '{view}',
                'header' => 'Permisos',
                'buttons' => [
                    
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-arrow-right"></span>', 
                                $url, 
                                [
                                    'id' => 'asignar_roles',
                                    'title' => Yii::t('app', 'Asignar Permisos'),
                                ]
                            );
                    },                    
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    
    </div>
    <div style="width: 50%; float: left; padding-left: 10px;">
        
    <h3>PERMISOS</h3>
    <p>
    
    <?= Html::a('Nuevo permiso', '#', [
//        'id' => 'nuevo_permiso',
        'class' => 'btn btn-success rolesypermisos',
        'data-toggle' => 'modal',
        'data-target' => '#modal',
        'data-url' => Url::to(['nuevo', 'id' => 2]),
        'data-pjax' => '0',
    ]); ?>
    
    </p>
    
    <?php Pjax::begin([
        'enablePushState' => false,
        'id' => 'permisos',
        ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
//            'type',
            'description:ntext',
//            'rule_name',
//            'data:ntext',
            // 'created_at',
            // 'updated_at',

            
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
    
</div>

<?php
$this->registerJs(
"$(document).on('click', '.rolesypermisos', (function() {
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
    'header' => '<h3>Roles y Permisos</h3>',
    'id' => 'modal',
//    'size' => 'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

