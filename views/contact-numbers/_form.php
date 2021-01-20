<?php

use borales\extensions\phoneInput\PhoneInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContactNumbers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-numbers-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <? try {
                echo $form->field($model, 'number')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'allowExtensions' => true,
                        'onlyCountries' => ['ua'],
                    ]]);
            }
            catch (Exception $e) { } ?>

            <?= Html::submitButton('Save number', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>