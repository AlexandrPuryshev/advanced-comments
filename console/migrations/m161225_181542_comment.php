<?php

use yii\db\Migration;

class m161225_181542_comment extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'parentId' => $this->integer(),
            'content' => $this->string()->notNull(),
            'postId' => $this->integer(),
            'authorId' => $this->integer()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci');

        $this->addForeignKey(
            'FK_comment_author', '{{%comment}}', 'authorId', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_comment_post', '{{%comment}}', 'postId', '{{%post}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
