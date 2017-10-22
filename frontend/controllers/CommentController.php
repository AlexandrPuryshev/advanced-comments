<?php

namespace frontend\controllers;

use Yii;
use common\models\db\Comment;
use common\models\db\Post;
use frontend\models\CommentForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\User;
use yii\helpers\Url;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add', 'index'],
                'rules' => [
                    [
                        'actions' => ['add', 'index'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Yii::$app->request->get();
        $postId = explode(":", $data['postId']);
        $dataProvider = $this->getCommentDataProvider(Comment::findCommentsByCurrentPost($postId));
        return $this->renderPartial('index', [
            'model' => $dataProvider,
            'commentForm' => new CommentForm(Url::to(['comment/add', 'id' => $postId])),
        ]);
    }

    protected function getCommentDataProvider($commentQuery)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $commentQuery,
        ]);

        return $dataProvider;
    }

    public function actionAdd()
    {
        $model = new Comment();
        if (Yii::$app->user instanceof User) {
            $model->authorId = Yii::$app->user->getIdentity()->getId();
        }
        if (Yii::$app->request->isAjax && Yii::$app->request->post('CommentForm') != null) {
            if (CommentForm::save($model, Yii::$app->request->post('CommentForm'))) {
                return $this->renderPartial('comment', [
                    'model' => $model
                ]);
            }
        }
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
