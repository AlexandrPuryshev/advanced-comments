<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="site-header__inner">
        <?php
        NavBar::begin([
            'brandLabel' => '<span>' . 'Blog Puryshev For Admins' . '</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'site-header navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' =>  '<span class="glyphicon glyphicon-home"></span> Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => Yii::$app->user->identity->username, 'items' => [
                        ['label' => 'List of users', 'url' => ['/user']],
                        ['label' => 'All Posts', 'url' => ['/post']],
                        ['label' => 'Categoryes', 'url' => ['/category']],
                        ['label' => 'Comments', 'url' => ['/comment']],
                        [
                           'label' => 'Logout',
                           'url' => ['/site/logout'],
                           'linkOptions' => ['data-method' => 'post']]
                        ]
                    ];
        }
        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'nav navbar-nav site-navigation__nav-list'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
