<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 14.10.2017
 * Time: 15:38
 */

?>

<?php echo '<h2 id="title-comments"> Comments </h2>' ?>
<?= $this->render('shortViewComments', [
    'model' => $model,
]) ?>

<?= $this->render('_form', [
    'model' => $commentForm
]); ?>
