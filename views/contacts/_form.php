<?php

use borales\extensions\phoneInput\PhoneInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $numbers app\models\ContactNumbers[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6"><?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-lg-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'birthday')->textInput(['type' => 'date', 'max' => date("Y") - $model->minAge . '-' . date("m") . '-' . date("d")]) ?></div>
    </div>

    <hr>
    <h3>Phone numbers</h3>
    <hr>

    <div class='numbers-list'>
        <? foreach($numbers as $index => $number) {
            try {
                echo "<div class=\"row\">" .
                    "<div class='col-lg-3'>" . $form->field($number, "[$index]number", ['template' => '{input}'])->textInput(['value' => $number->number])->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'allowExtensions' => true,
                        'onlyCountries' => ['ua'],
                    ]]) . "</div>";
                    if($index > 0) {
                        echo "<div class='col-lg-1'>" . Html::a('', ['../contact-numbers/delete', 'id' => $number->id], [
                            'class' => 'btn btn-danger fa fa-times',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this number?',
                                'method' => 'post',
                            ],
                        ]) . "</div>";
                    }
                echo "</div>";
            }
            catch (Exception $e) { }
        } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>