<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model common\models\Post */
/* @var TagPost $postTag */
?>


<div class="content_posts">

    <h1>Title: <?= $model->title ?></h1>

    <div class="meta">
        <br>

        <?php
        if (isset($model->image)) {
            echo Html::img(Url::to(Yii::getAlias('@imageUrlPathPost')) . '/' . $model->image, ['style' => 'width: 45%;']);
        }
        ?>
    </div>

    <br>

    <?php
    if (isset($model->category)) {
        echo "<p> Category: " . Html::a($model->category->name, ['category/view', 'id' => $model->category->id]) . "</p>";
    }
    ?>

    <div class="content">
        Description: <?= $model->anons ?>
    </div>

    <br>

    <?= Html::a('Read more', ['post/view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
</div>


<hr class="smallHr">