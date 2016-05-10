<?php

namespace app\controllers;

use Yii;
use app\models\AuthItem;
use app\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\widgets\ActiveForm;
use yii\web\Response;

use app\models\RolesyPermisos;
use yii\data\ActiveDataProvider;

use app\models\AuthItemChild;


/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $searchModel = new AuthItemSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider1 = new ActiveDataProvider([
            'query' => AuthItem::find()->where('type = 1'),
            'pagination'    =>  [
                'pageSize' =>  20,
            ]
        ]);
        
        $dataProvider2 = new ActiveDataProvider([
            'query' => AuthItem::find()->where('type = 2'),
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
                
        return $this->render('index', [
//            'searchModel' => $searchModel,
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model1 = AuthItem::find()->where('name = "'.$id.'" and type = 1')->one();
        
        if(empty($model1))
        {
            throw new NotFoundHttpException('ERROR con la Url del sistema. ! ');
        }
        else
        {
            
            $padre_hijo = new ActiveDataProvider([
                'query' => AuthItemChild::find()->where('parent = "'.$model1->name.'"'),
                'pagination'    =>  [
                    'pageSize' =>  20,
                ]
            ]);
            
            $searchModel = new AuthItemSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('view', [
                'model1' => $model1,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'padre_hijo' => $padre_hijo,
            ]);
        }
        
            
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionNuevo($id, $submit = false)
    {
        //$id viene a ser el tipo 1 => ROL y 2 => PERMISO
        $model = new RolesyPermisos();
        $model->tipo = $id;
        
        if($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isAjax && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->validate())
            {
                $auth = \Yii::$app->authManager;
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($model->tipo == 1)
                {
                    $rol = $auth->createRole($model->nombre);
                    $rol->description = $model->descripcion;
                    
                    if($auth->add($rol))
                    {
                        return [
                            'message' => '<div class="alert alert-success" role="alert">¡El rol <b>'.$model->nombre.'</b> se creó SATISFACTORIAMENTE.!</div>',
                            'tipo' => 1,
                        ];
                    }
                    else
                    {
                        return [
                            'message' => '<div class="alert alert-danger" role="alert"><b>¡Error!. El rol no se pudo crear satisfactoriamente</b></div>',
                        ];
                    }
                }
                if($model->tipo == 2)
                {
                    $permiso = $auth->createPermission($model->nombre);
                    $permiso->description = $model->descripcion;
                    
                    if($auth->add($permiso))
                    {
                        return [
                            'message' => '<div class="alert alert-success" role="alert">¡El permiso <b>'.$model->nombre.'</b> se creó SATISFACTORIAMENTE.!</div>',
                            'tipo' => 2,
                        ];
                    }
                    else
                    {
                        return [
                            'message' => '<div class="alert alert-danger" role="alert"><b>¡Error!. El rol no se pudo crear satisfactoriamente</b></div>',
                        ];
                    }                    
                }
//                return $this->redirect(['index']);
            }
            else
            {
                $model->getErrors();
            }
        }
        
        if (!$model->load(Yii::$app->request->post())) {
            
            return $this->renderAjax('rolesypermisos',[
                'model' => $model,
            ]);
        }   
    }
    
    public function actionAsignarpermiso($padre, $hijo)
    {
        if(!empty($padre) && !empty($hijo))
        {
                        
            $auth = \Yii::$app->authManager;
            
            $padre_hijo = AuthItemChild::find()->where('parent = "'.$padre.'" and child = "'.$hijo.'"')->one();
            $rol = $auth->getRole($padre);
            $permiso = $auth->getPermission($hijo);
            
            if(empty($padre_hijo))
            {
                
                if($auth->addChild($rol, $permiso))
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El permiso se asignó <b>SATISFACTORIAMENTE</b>!</div>',
                    ];           
                }
                else
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'message' => '<div class="alert alert-danger" role="alert"><b>¡Error!. No se pudo realizar la acción</b></div>',
                    ];
                }
            }
            else
            {
                
                if($auth->removeChild($rol, $permiso))
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El permiso se quitó <b>SATISFACTORIAMENTE</b>!</div>',
                    ];           
                }
                else
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'message' => '<div class="alert alert-danger" role="alert"><b>¡Error!. No se pudo realizar la acción</b></div>',
                    ];
                }
            }   
        }
        else
        {
            throw new NotFoundHttpException('Error. Url incorrecto');
        }
    }
    
    
}
