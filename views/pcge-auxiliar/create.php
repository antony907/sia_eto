<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PcgeAuxiliar */

$this->title = 'Create Pcge Auxiliar';
$this->params['breadcrumbs'][] = ['label' => 'Pcge Auxiliars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-auxiliar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
