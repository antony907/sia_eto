<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

use app\models\AuthItemChild;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */

$this->title = $model1->name;
//$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

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
        <?= Html::a(' Roles/Permisos', ['/auth-item'], ['class' => 'btn btn-default glyphicon glyphicon-arrow-left',]) ?>
    </p>
    
    <h1><?php //echo Html::encode($this->title) ?></h1>

    <div id="mensaje1"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h6 class="panel-title" style="text-align: center;"><b><?= $model1->name ?></b></h6>
        </div>
        <div class="panel-body">
            <b>Desripción: </b><?= $model1->description ?>
        </div>
        <?php 
                Pjax::begin([
                'enablePushState' => false,
                'id' => 'permisos2',
                ]); ?>
        <div class="table-responsive">
            <table class="table">
                
                <?= GridView::widget([
                    'dataProvider' => $padre_hijo,
//                    'filterModel' => $searchModel,
                    'showOnEmpty'=>false,
                    'summary'=>'',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'child',
                        'child0.description',
//                        'description:ntext',                        
                    ],
                ]); ?>
                
                
            </table>
        </div>
        <?php
//                $ventana1->end();
                Pjax::end();
                ?>
    </div>

    <?php 
    
    
    Pjax::begin([
        'enablePushState' => false,
        'id' => 'permisos',
        ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>false,
        'summary'=>'',
        'rowOptions' => function($model){
            if($model->type == 1)
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
                'template' => '{asignarpermiso}',
                'header' => 'Estado',
                'buttons' => [
                    
                    'asignarpermiso' => function($url, $model){
            
                        $padre_hijo = AuthItemChild::find()->where('parent = "'.$this->title.'" and child = "'.$model->name.'"')->one();
                        if(!empty($padre_hijo))
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-minus btn btn-danger btn-xs"></span>',
                                        '#',
                                        [
//                                            'title' => 'Desactivar',
//                                            'class' => 'cambiar_estado',
                                            
                                            'id' => 'asignarpermiso',
                                            'title' => Yii::t('app', 'Quitar'),
                                            'data-url' => Url::to(['asignarpermiso', 'padre' => $this->title, 'hijo' => $model->name]),
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
                                            
                                            'id' => 'asignarpermiso',
                                            'title' => Yii::t('app', 'Asignar'),
                                            'data-url' => Url::to(['asignarpermiso', 'padre' => $this->title, 'hijo' => $model->name]),
                                            'data-pjax' => '0',
                                        ]
                                    );
                        }
                    },
                ]
            ],
        ],
    ]); ?>
    <?php 
//    $ventana2->end();
    Pjax::end(); 
    ?>

</div>

<?php
$script = <<< JS

$(document).on('click', '#asignarpermiso', (function() {
//    alert('ola');
//    return false;
        $.get(
            $(this).data('url'),
            function (data) {
                $.pjax.reload({container:'#permisos', async:false});
                $.pjax.reload({container:'#permisos2', async:false});
                $('#mensaje1').html(data.message);
            }
        );
    }));

JS;
$this->registerJs($script);
?>