<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PcgeDivisoria */

$this->title = 'Create Pcge Divisoria';
$this->params['breadcrumbs'][] = ['label' => 'Pcge Divisorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-divisoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
