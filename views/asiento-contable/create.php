<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AsientoContable */

$this->title = 'Create Asiento Contable';
$this->params['breadcrumbs'][] = ['label' => 'Asiento Contables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-contable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
