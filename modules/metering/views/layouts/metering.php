<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;
use app\models\User;

//Если не замерщик перенаправляем на главную
if(!(User::getRole(Yii::$app->user->getId())==User::TYPE_METERING)){
    Yii::$app->getResponse()->redirect(Yii::$app->getUser()->loginUrl);
}


AppAsset::register($this);
?>
<?php $this->beginPage();
//Для телефона или планшета:
if(\Yii::$app->mobileDetect->isMobile() or \Yii::$app->mobileDetect->isTablet()) {
    ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="background-image: url('/web/uploads/images/mobile/background.jpg'); background-repeat: no-repeat" >
    <?php //убрать  background в css
    $this->beginBody();
    ///web/uploads/images/mobile/background.jpg

    print('<div class="wrap">');

        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);

        $menuItems = [
            ['label' => 'Новые заказы', 'url' => ['/metering/default/new-request']],
            ['label' => 'Мои заказы', 'url' => ['/metering/default/my-request']],
            ['label' => 'Мои отклики', 'url' => ['/metering/default/my-response']],
            ['label' => 'Мои данные', 'url' => ['/metering/default/update-user']],
//            ['label' => 'Уведомления', 'url' => ['#']],
//            ['label' => 'Документы', 'url' => ['#']],
            ['label' => 'Баланс', 'url' => ['#']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);

        NavBar::end();


        $this->registerCssFile('/web/css/css-circle/css/circle.css');
    ?>

    <div class="row">
        <div class="col-xs-3">
            <strong> Заказов </strong>
            <div class="c100 p25 small">
                <span>25%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Активность</strong>
            <div class="c100 p40 small">
                <span>40%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Конверсия</strong>
            <div class="c100 p50 small">
                <span>50%</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <strong>Задач</strong>
            <div class="c100 p25 small">
                <span>2</span>
                <div class="slice">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="block-info">
        <div class="row">
            <div class="col-xs-6">
                Баланс:
                </br>
                </br>
                Текущих заказов:
                </br>
                </br>
            </div>
            <div class="col-xs-3">
                <img class="mr-3" src="/web/uploads/images/mobile/request-diagram.jpg" >
            </div>

        </div>
    </div>



    <div class="container">
        <div class="col-sm-6">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php
};








//Для компьютера
if(\Yii::$app->mobileDetect->isDesktop()) {
    ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>


        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <?php /*print_r(Yii::$app->user);*/ ?>
            <div class="row">
                <div class="col-sm-3">
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => 'Новые заказы', 'url' => ['/metering/default/new-request']],
                            ['label' => 'Мои заказы', 'url' => ['/metering/default/my-request']],
                            ['label' => 'Мои отклики', 'url' => ['/metering/default/my-response']],
                            ['label' => 'Мои данные', 'url' => ['/metering/default/update-user']],
                            ['label' => 'Уведомления', 'url' => ['#']],
                            ['label' => 'Документы', 'url' => ['#']],
                            ['label' => 'Баланс', 'url' => ['#']],

                        ],
                    ]);
                    ?>
                </div>
                <div class="col-sm-9">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">Натяжные потолки <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>

    <?php };
$this->endPage();

?>
