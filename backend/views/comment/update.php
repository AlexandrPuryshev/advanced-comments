<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\BaseComment */

$this->title = 'Update Base Comment: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Base Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
