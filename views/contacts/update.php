<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $numbers app\models\ContactNumbers */

$this->title = 'Update contact: ' . $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name . ' ' . $model->last_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update contact';
?>

<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'numbers')) ?>

</div>