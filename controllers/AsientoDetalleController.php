<?php

namespace app\controllers;

use Yii;
use app\models\AsientoDetalle;
use app\models\AsientoDetalleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use app\models\AsientoContable;

/**
 * AsientoDetalleController implements the CRUD actions for AsientoDetalle model.
 */
class AsientoDetalleController extends Controller
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
     * Lists all AsientoDetalle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsientoDetalleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AsientoDetalle model.
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
     * Creates a new AsientoDetalle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AsientoDetalle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AsientoDetalle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AsientoDetalle model.
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
     * Finds the AsientoDetalle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AsientoDetalle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AsientoDetalle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionVer($id = null)
    {
        if(empty($id))
        {
            throw new NotFoundHttpException('No existe este asiento contable.');
        }
        else
        {
//            $asiento_detalle = AsientoDetalle::find()
//                    ->where('asiento_contable_id = '.$id)
//                    ->all();
//            $searchModel = new AsientoDetalleSearch();
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $asiento_contable = AsientoContable::findOne($id);
            
            $dataProvider = new ActiveDataProvider([
                'query' => AsientoDetalle::find()->where('asiento_contable_id = '.$id),
                'pagination'    =>  [
                    'pageSize' =>  20,
                ]
            ]);
            
            return $this->render('ver', [
                'asiento_contable' => $asiento_contable,
//                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        
            
    }
}
