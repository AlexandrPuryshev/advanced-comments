<?php

namespace frontend\views;

use yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="comment-form">
    <?php $form = ActiveForm::begin([
        'action' => ['comment/add'],
        'options' => ['id' => 'comment-form-id'],
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
    ]); ?>
        
    <?= $form->field($model, 'postId')->hiddenInput(['value' => $model->postId])->label(false) ?>
    <?= $form->field($model, 'parentId')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'content')->textarea(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['id' => 'btnCommentSbmt', 'class' => 'btn btn-success', 'data-method' => 'post']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    $('#comment-form-id').on('beforeSubmit', function(e) {
        addCommentFromForm();
        return false;
    }).on('submit', function(e){
        addCommentFromForm();
        return false;
    });
</script>