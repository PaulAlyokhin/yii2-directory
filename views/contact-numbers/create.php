<?php

/* @var $this yii\web\View */
/* @var $model app\models\ContactNumbers */

$this->title = 'Create Contact Numbers';
$this->params['breadcrumbs'][] = ['label' => 'Contact Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-numbers-create">

    <?= $this->render('_form', compact('model')) ?>

</div>