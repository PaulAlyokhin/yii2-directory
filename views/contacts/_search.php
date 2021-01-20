<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-search">

    <?php $form = ActiveForm::begin([
        'id' => 'search-form',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <?= $form->field($model, 'search', ['template' => '{input}', 'options' => ['style' => 'display: inline-block;']])->label(false) ?>
            <?= Html::submitButton('', ['class' => 'btn btn-primary fa fa-search']) ?>
            <?= Html::button('', ['class' => 'btn btn-outline-secondary fa fa-times', 'onclick' => 'document.getElementById("contactssearch-search").value = "";']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>