<?php

namespace app\controllers;

use app\models\ContactNumbers;
use Yii;
use app\models\Contacts;
use app\models\ContactsSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Contacts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Contacts();

        $count = count(Yii::$app->request->post('ContactNumbers', []));
        $numbers = [new ContactNumbers()];
        for($i = 1; $i < $count; $i++) {
            $numbers[] = new ContactNumbers();
        }

        if($model->load(Yii::$app->request->post()) && Model::loadMultiple($numbers, Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $model->save();

                foreach($numbers as $number) {
                    $number->contact_id = $model->id;
                    $number->save();
                }

                $transaction->commit();
            }
            catch(\Exception $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('creatingDenied');

                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact('model', 'numbers'));
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $count = count(Yii::$app->request->post('ContactNumbers', []));
        $numbers = count($model->contactNumbers) > 0 ? $model->contactNumbers : [new ContactNumbers()];
        for($i = 1; $i < $count; $i++) {
            $numbers[] = new ContactNumbers();
        }

        if($model->load(Yii::$app->request->post()) && $model->save() && Model::loadMultiple($numbers, Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $model->save();

                foreach($numbers as $number) {
                    $number->contact_id = $model->id;
                    $number->save();
                }

                $transaction->commit();
            }
            catch(\Exception $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('updatingDenied');

                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'numbers'));
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if(($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}