<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\BaseComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="base-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parentId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postId')->dropDownList(
        ArrayHelper::map($posts, 'id', 'title')
    ) ?>

    <?= $form->field($model, 'authorId')->dropDownList(
        ArrayHelper::map($users, 'id', 'username')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
