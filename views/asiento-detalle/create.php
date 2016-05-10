<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AsientoDetalle */

$this->title = 'Create Asiento Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Asiento Detalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-detalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
