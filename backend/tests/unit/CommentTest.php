<?php

namespace backend\tests\unit\models;

use common\models\db\Comment;
use common\tests\_fixtures\CommentFixture;
use frontend\models\CommentForm;
use yii;

/**
 * Login form test
 */
class CommentTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    const COMMENT_ID = 1;
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'commentData' => [
                'class' => CommentFixture::className(),
                'dataFile' => codecept_data_dir() . 'commentData.php'
            ]
        ]);
    }

    private function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    private function createNewComment()
    {
        $model = new Comment();
        $comment = $this->tester->grabFixture('commentData', 0);
        $model->authorId = $comment['authorId'];
        $dataArray = [
            'postId' => '' . $comment['postId'],
            'content' => '' . $comment['content'],
            'parentId' => ''
        ];
        return CommentForm::save($model, $dataArray);
    }

    public function testCommentAdd()
    {
        $isSave = $this->createNewComment();
        expect('comment is not save', $isSave)->true();
    }

    public function testCommentAddInNonExistPost()
    {
        $model = new Comment();
        $comment = $this->tester->grabFixture('commentData', 0);
        $model->authorId = $comment['authorId'];
        $dataArray = [
            'postId' => '' . 124,
            'content' => '' . $comment['content'],
            'parentId' => ''
        ];
        $isSave = CommentForm::save($model, $dataArray);
        expect('comment is not save', $isSave)->false();
    }

    public function testCommentDelete()
    {
        $isSave = $this->createNewComment();
        expect('comment is not save', $isSave)->true();
        $this->findModel(CommentTest::COMMENT_ID)->delete();
        expect('comment is not delete', $this->findModel(CommentTest::COMMENT_ID))->null();
    }
}
