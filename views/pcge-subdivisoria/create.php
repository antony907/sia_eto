<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PcgeSubdivisoria */

$this->title = 'Create Pcge Subdivisoria';
$this->params['breadcrumbs'][] = ['label' => 'Pcge Subdivisorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcge-subdivisoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
