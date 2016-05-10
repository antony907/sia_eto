<?php

namespace app\controllers;

use Yii;
use app\models\AsientoContable;
use app\models\AsientoContableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AsientoDetalle;
use yii\data\ActiveDataProvider;

/**
 * AsientoContableController implements the CRUD actions for AsientoContable model.
 */
class AsientoContableController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all AsientoContable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsientoContableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AsientoContable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AsientoContable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AsientoContable();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/asiento-detalle/ver', 'id' => $model->id]);
        } else {
            
            $asiento_contable = AsientoContable::find()->select('max(num_asiento) as num_asiento')->where('anio = 2016 and mes = 4')->one();
            $model->num_asiento = $asiento_contable->num_asiento + 1;
            $model->anio = 2016;
            $model->mes = 04;
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AsientoContable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/asiento-detalle/ver', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AsientoContable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AsientoContable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AsientoContable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AsientoContable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionVer($id)
    {
//        $searchModel = new AsientoDetalleSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider = new ActiveDataProvider([
                'query' => AsientoDetalle::find()->where('asiento_contable_id = '.$id),
                'pagination'    =>  [
                    'pageSize' =>  20,
                ]
            ]);
        
        return $this->render('ver', [
            'model' => $this->findModel($id),
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
