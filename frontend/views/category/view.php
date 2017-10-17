<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 2:14
 */
namespace frontend\views\category;

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var $category \common\models\db\Category текущая категория */
/** @var $categories \yii\data\ActiveDataProvider список категорий */
/** @var $posts \yii\data\ActiveDataProvider список категорий */

$this->title = 'Category ' . $category->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr class="smallHr">

    <?php
    foreach ($posts->models as $post) {
        echo $this->render('//post/shortView', [
            'model' => $post
        ]);
    }
    ?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar sidebar">
    <h1 class="category">Category</h1>
    <ul>
        <?php
        foreach ($categories->models as $category) {
            echo $this->render('shortViewCategory', [
                'model' => $category
            ]);
        }
        ?>
    </ul>
</div>