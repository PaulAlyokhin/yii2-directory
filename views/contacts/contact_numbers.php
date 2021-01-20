<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactNumbers */
/* @var $form ActiveForm */
?>

<div class="contact_numbers">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'contact_id') ?>
        <?= $form->field($model, 'number') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>