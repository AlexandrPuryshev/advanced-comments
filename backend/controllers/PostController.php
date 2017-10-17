<?php

namespace backend\controllers;

use common\models\db\Category;
use common\models\db\User;
use yii;
use common\models\forms\UploadForm;
use yii\web\UploadedFile;
use common\models\db\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for BasePost model.
 */
class PostController extends Controller
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
     * Lists all BasePost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BasePost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    private function saveModel($model, $view)
    {
        $upload = new UploadForm();
        /* push auto author id in field author_id */
        $model->authorId = Yii::$app->user->id;
        $upload->imageFile = UploadedFile::getInstance($upload, 'imageFile');
        // if you update, older image you delete, if uploading image is null
        $pathForImage = (Yii::getAlias('@app') . "\\web\\" . Yii::getAlias('@imageUrlPathPost'). '\\' . $model->image . ".jpg");

        if ($view == 'update') {
            if(file_exists($pathForImage)){
                unlink($pathForImage);
            }
            $model->image = null;
        }

        if ($upload->upload("post")) {
            $model->image = $upload->name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render($view, [
                'model' => $model,
                'image' => $upload,
                'authors' => User::find()->all(),
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Создание поста.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Post();
        return $this->saveModel($model, 'create');
    }


    /**
     * Редактирование поста.
     * @param string $id идентификатор редактируемого поста
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->saveModel($model, 'update');
    }


    /**
     * Deletes an existing BasePost model.
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
     * Finds the BasePost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BasePost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
