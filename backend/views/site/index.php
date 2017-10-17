<?php

/* @var $this yii\web\View */
namespace backend\views\site;

use Yii;

$this->title = 'Admin Page';
?>
<div class="site-index">
    <canvas id='canvas'></canvas>
</div>

<?php echo ("<script src='" . Yii::getAlias("@web") . "/js/banner.js'></script>"); ?>
