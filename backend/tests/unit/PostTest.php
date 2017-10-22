<?php

namespace backend\tests\unit\models;

use common\models\db\Post;
use common\tests\_fixtures\PostFixture;
use yii;

/**
 * Login form test
 */
class PostTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    const POST_ID = 1;
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    private function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    private function createNewPost()
    {
        $model = new Post();
        $post = $this->tester->grabFixture('post', 0);
        $model->authorId = $post['authorId'];
        $model->content = $post['content'];
        $model->anons = $post['anons'];
        $model->title = $post['title'];
        $model->categoryId = $post['categoryId'];
        $model->publishStatus = $post['publishStatus'];
        $model->createdAt = $post['createdAt'];
        $model->updatedAt = $post['updatedAt'];
        return ($model->save());
    }

    public function testPostAdd()
    {
        $isSave = $this->createNewPost();
        expect('post is not save', $isSave)->true();
    }

    public function testPostDelete()
    {
        $isSave = $this->createNewPost();
        expect('post is not save', $isSave)->true();
        $this->findModel(PostTest::POST_ID)->delete();
        expect('comment is not delete', $this->findModel(PostTest::POST_ID))->null();
    }
}
