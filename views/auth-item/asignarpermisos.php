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

    
    
    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'template' => '{asignarpermisos}',
                'header' => 'Asignar Permisos',
//                'options' => ['style'=>'background: red;'],
                'buttons' => [
                    'asignarpermisos' => function($url, $model){
                        if($model->type == 1)
                        {
                            return Html::a(
                                        '<span class="glyphicon glyphicon-eye-open"></span>',
                                        '#',
                                        [
                                            'title' => 'ROL',
                                            'value' => $url,
                                            'class' => 'modalClase',
                                        ]
                                    );
                        }
                    },
                            
                ],
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
</div>
