<?php

namespace common\models\db;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Модель комментариев.
 *
 * @property integer $id
 * @property integer $pid идентификатор родительского комментария
 * @property string $content комментарий
 * @property string $publish_status статус публикации
 * @property integer $post_id идентификатор поста, к которому относится комментарий
 * @property integer $author_id идентификатор автора комментария
 *
 * @property Post $post
 * @property User $author
 */
class Comment extends BaseComment
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentId' => 'Parent name',
            'content' => 'Content',
            'postId' => 'Post name',
            'authorId' => 'Author name',
        ];
    }

    /**
     * Возвращает опубликованные комментарии
     * @return ActiveQuery
     */
    public static function findCommentsByCurrentPost($id)
    {
        return self::find()->where(['postId' => $id]);
    }

    /**
     * Возвращает комментарий.
     * @param int $id идентификатор комментария
     * @throws NotFoundHttpException
     * @return Comment
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
