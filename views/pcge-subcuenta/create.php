<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PcgeSubcuenta */

$this->title = 'Create Pcge Subcuenta';
$this->params['breadcrumbs'][] = ['label' => 'Pcge Subcuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-subcuenta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
