<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SignupForm;

use yii\widgets\ActiveForm;
use yii\web\Response;

use app\models\AuthItem;
use app\models\AuthItemSearch;
use app\models\RolesyPermisos;
use app\models\AuthAssignment;
use yii\data\ActiveDataProvider;

use yii\web\ForbiddenHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
//        if(!Yii::$app->user->can('usuario-listar'))
//        {
//            throw new ForbiddenHttpException('Ud. no tiene permiso para ver éste contenido');
//        }
        
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = User::findOne($id);
        
        if(empty($model))
        {
            throw new NotFoundHttpException('ERROR con la Url del sistema. ! ');
        }
        else
        {
            $searchModel = new AuthItemSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $user_asignado = new ActiveDataProvider([
                'query' => AuthAssignment::find()->where('user_id = '.$id),
                'pagination'    =>  [
                    'pageSize' =>  20,
                ]
            ]);

            return $this->render('view', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'user_asignado' => $user_asignado,
            ]);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSignup($submit = false)
    {        
        $model = new SignupForm();
        
        if($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isAjax && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->validate())
            {
                if ($user = $model->signup()) {
                    
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        
        if (!$model->load(Yii::$app->request->post())) {
            
            return $this->renderAjax('signup', [
                'model' => $model,
            ]);
        }

            
    }
    
    public function actionCambiarestado($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $usuario = $this->findModel($id);
            
            if($usuario->status == 0)
            {
                $usuario->status = 10;
            }
            else
            {
                $usuario->status = 0;
            }
            
            if($usuario->update())
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                
                if($usuario->status == 10)
                {
                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El usuario <b>'.$usuario->username.'</b> está <b>ACTIVADO</b>!</div>',
                    ];
                }
                else
                {
                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El usuario <b>'.$usuario->username.'</b> está <b>DESACTIVADO</b>!</div>',
                    ];
                }                
            }
            else
            {
                return [
                    'message' => '<div class="alert alert-danger" role="alert"><b>¡Error!. El usuario no se pudo cambiar de estado satisfactoriamente</b></div>',
                ];
            }
            
//            $usuario->update();
//            return $this->redirect(['index']);
        }
        else
        {
            throw new NotFoundHttpException('Error. Url incorrecto');
        }
    }
    
    public function actionActualizar($id, $submit = false)
    {
        $model = $this->findModel($id);

        if($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isAjax && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
                
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->validate())
            {
                $user = $this->findModel($id);
                $user->email = $model->email;
                $user->setPassword($model->password_hash);
                $user->generateAuthKey();

                if($user->update())
                {
                    echo 1;
//                    return $this->redirect(['index']);
                }
                else
                {
                    echo 0;
                }
                    
            }
            else
            {
                $model->getErrors();
            }
        }

        if (!$model->load(Yii::$app->request->post())) {
        
            return $this->renderAjax('actualizar', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionAsignarrol($rol, $id_user)
    {
        if(!empty($rol) && !empty($id_user))
        {
            $auth = \Yii::$app->authManager;
            
            $user_rol = AuthAssignment::find()->where('item_name = "'.$rol.'" and user_id = '.$id_user)->one();
            $rol = $auth->getRole($rol);
            
            if(empty($user_rol))
            {
                if($auth->assign($rol, $id_user))
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El Rol se asignó <b>SATISFACTORIAMENTE</b>!</div>',
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
                if($auth->revoke($rol, $id_user))
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'message' => '<div class="alert alert-success" role="alert">¡El Rol se quitó <b>SATISFACTORIAMENTE</b>!</div>',
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
