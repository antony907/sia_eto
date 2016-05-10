<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PcgeCuenta */

$this->title = 'Create Pcge Cuenta';
$this->params['breadcrumbs'][] = ['label' => 'Pcge Cuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-cuenta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
