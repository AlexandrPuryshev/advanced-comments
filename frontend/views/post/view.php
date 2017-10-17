<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['//site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $image = null;
    $categoryName = null;
    if (isset($model->image)) {
        $image = 'image/post/' . $model->image;
    }
    if (isset($model->categoryId)) {
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Not Defined'],
        'attributes' => [
            [
                'attribute' => 'image',
                'value' => $image,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'title',
            'anons:ntext',
            'content:ntext',
            'category.name',
            'author.username',
            'publishStatus',
            'createdAt',
        ],
    ]) ?>
    <?php $url = Yii::$app->getUrlManager()->createUrl('comment/index'); ?>
    <?php $data = Yii::$app->request->get('id'); ?>
    <a id="linkLoadComments" onclick="getCommentsAjax('<?= $url ?>', '<?= $data ?>')"> Загрузить комментарии </a>
    <div id="comment-container">
    </div>
</div>
