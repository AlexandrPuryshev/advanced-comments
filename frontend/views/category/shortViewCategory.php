<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 1:39
 */

/* @var $model common\models\db\Category */
?>
<li><?= \yii\helpers\Html::a($model->name, ['category/view', 'id' => $model->id])?></li>