<?php

use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="contacts-view">

    <hr>
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item? All associated phone numbers will be deleted too',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'email:email',
            'birthday',
        ],
    ]) ?>

    <hr>
    <h3>Phone numbers</h3>
    <hr>

    <? Pjax::begin(['enablePushState' => false]);
        echo Html::a('Add number', ['../contact-numbers/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
    Pjax::end(); ?>

    <br>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getContactNumbers()]),
        'columns' => [
            'number',
        ],
    ]) ?>

</div>