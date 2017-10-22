<?php

namespace frontend\tests\unit\models;

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

    public function testCommentAdd()
    {
        $model = new Comment();
        $comment = $this->tester->grabFixture('commentData', 0);
        $model->authorId = $comment['authorId'];
        $dataArray = [
            'postId' => '' . $comment['postId'],
            'content' => '' . $comment['content'],
            'parentId' => ''
        ];
        $isSave = CommentForm::save($model, $dataArray);
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
}
