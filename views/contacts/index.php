<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['enablePushState' => false]); ?>

    <div class="row">
        <div class="col-lg-3"><?= Html::a('Create contact', ['create'], ['class' => 'btn btn-success']) ?></div>
        <div class="col-lg-9 text-right"><?= $this->render('_search', ['model' => $searchModel]); ?></div>
    </div>

    <?php if(Yii::$app->session->hasFlash('creatingDenied')): ?>
        <p class="alert alert-error">An error occurred when creating the contact.</p>
    <?php elseif(Yii::$app->session->hasFlash('updatingDenied')): ?>
        <p class="alert alert-error">An error occurred when updating the contact.</p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Name',
                'value' => function($dataProvider) {
                    return $dataProvider->first_name . ' ' . $dataProvider->last_name;
                },
                'contentOptions' => ['style' => 'width: 300px;'],
            ],
            [
                'attribute' => 'Numbers',
                'value' => function($dataProvider) {
                    $result = "";
                    foreach($dataProvider->contactNumbers as $contactNumber) {
                        if(strlen($result) > 0) $result .= ', ';
                        $result .= $contactNumber->number;
                    }
                    return $result;
                },
                'contentOptions' => ['style' => 'width: 50%;'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>