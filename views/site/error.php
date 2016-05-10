<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Se ha producido un error, mientras que el servidor Web estaba procesando su solicitud.
    </p>
    <p>
        Por favor pongase en contacto cono el Administrador del Sistema si Ud. piensa que esto es un error del servidor. Gracias
    </p>

</div>
