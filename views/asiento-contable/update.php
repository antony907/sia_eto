<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoContable */

$this->title = 'Update Asiento Contable: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asiento Contables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asiento-contable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
