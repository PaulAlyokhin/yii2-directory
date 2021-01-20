<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $numbers app\models\ContactNumbers */

$this->title = 'Create contact';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contacts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'numbers')) ?>

</div>