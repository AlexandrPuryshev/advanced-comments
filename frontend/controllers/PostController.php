<?php

namespace frontend\controllers;

use common\models\db\Category;
use common\models\db\User;
use common\models\LoginForm;
use frontend\models\CommentForm;
use common\models\db\Comment;
use Yii;
use common\models\db\Post;
use common\models\db\PostSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use frontend\models\UploadForm;
use yii\web\UploadedFile;
use yii\bootstrap\Alert;
use yii\db\Expression;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\Url;
/**
 * CRUD операции модели "Посты".
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'index'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Ренденр поста.
     * @param ActiveDataProvider $dataProvider модель поста
     * @param CategoryBase $CategoryBase модель категории
     * @param string $whatRender какую view рендерим
     **/
    protected function renderIndex($dataProvider, $сategory, $whatRender)
    {
    	$postQuery = $сategory->findCategoryes();

    	$dataProviderCategory = new ActiveDataProvider([
    			'query' => $postQuery,
    	]);

        return $this->render($whatRender, [
            'models' => $dataProvider,
            'categories' => $dataProviderCategory,
        ]);
    }

    protected function getPostDataProvider($postQuery)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $postQuery,
            'pagination' => [
                'pageSize' => 3,
                'validatePage' => false,
            ]
        ]);

        return $dataProvider;
    }

    public function actionHome()
    {
        $category = new Category();
        $postQuery = Post::findPublishedPosts();
        $dataProvider = $this->getPostDataProvider($postQuery);
        return $this->renderIndex($dataProvider, $category, 'indexHome');
    }
    
    /**
     * Просмотр поста.
     * @param string $id идентификатор поста
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
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
