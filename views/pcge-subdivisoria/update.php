<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PcgeSubdivisoria */

$this->title = 'Update Pcge Subdivisoria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pcge Subdivisorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pcge-subdivisoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
