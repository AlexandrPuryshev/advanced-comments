<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\BaseComment */

$this->title = 'Create Comment';
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'posts' => $posts,
        'users' => $users
    ]) ?>

</div>
