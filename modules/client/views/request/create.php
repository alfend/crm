<?php

use yii\helpers\Html;
use app\models\Request;
use app\models\Response;
use app\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Заказать замер';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php
    //Список заказов на замер

    $script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#refreshButton').click();
    }, 3000);
});
JS;
    $this->registerJs($script);
    ?>

    <?php Pjax::begin(); ?>

    <?php
    //кол-во заявок
    $count_request=0;
    //кол-во замеров
    $count_request_metering=0;
    //кол-во заказов
    $count_request_zakaz=0;
    //кол-во сообщений
    $count_message=0;
    //кол-во сообщений непрочитаных
    $count_message_not_read=0;
    //кол-во задач
    $count_task=0;
    //кол-во не выполненных задач
    $count_task_not_read=0;
    //баланс вытянуть из бд
    $balance=0;

    $array_request = new Request();

    foreach ($request_metering as $request){
        $count_request++;
        if(in_array($request['status_request'], array($array_request::STATUS_METERING_BEFORE,$array_request::STATUS_METERING_RUN)))
        {
            $count_request_metering++;
        };

        if(in_array($request['status_request'], array($array_request::STATUS_METERING_AFTER,
            $array_request::STATUS_COMPANY_BEFORE,$array_request::STATUS_COMPANY_RUN,
            $array_request::STATUS_COMPANY_AFTER,$array_request::STATUS_DELIVERY_BEFORE,$array_request::STATUS_DELIVERY_RUN,$array_request::STATUS_DELIVERY_AFTER,
            $array_request::STATUS_MOUNTING_BEFORE,$array_request::STATUS_MOUNTING_RUN,$array_request::STATUS_MOUNTING_AFTER)))
        {
            $count_request_zakaz++;
        };

    };

    if($count_request==0)
    {
        $procent_metering=100;
        $procent_zakaz=100;
    } else {
        $procent_metering=$count_request_metering/$count_request*100;
        $procent_zakaz=$count_request_zakaz/$count_request*100;
    }
    if($count_message==0)
    {
        $procent_message=100;
    } else{
        $procent_message=$count_message_not_read/$count_message*100;
    }
    if($count_task==0)
    {
        $procent_task=100;
    } else {
        $procent_task=$count_task_not_read/$count_task*100;
    }

    ?>
    <section class="sec sec-header">

        <div class="container container-xs px-0" id="counters">

            <div class="row flex-nowrap">

                <div class="col-3 pb-1">
                    <h6 class="color-dark text-uppercase text-center">Замеров</h6>
                    <div class="counter m-2">
                        <?= //Html::a('Обновить',['/client'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);/* ,'style' => "display:none" */
                        '';
                        ?>

                        <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                            <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                            <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_metering; ?>, 100" stroke-dashoffset="<?= $procent_metering; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                        </svg>
                        <div class="counter__value"><span><?= $count_request_metering; ?></span></div>
                    </div>
                    <!-- /.counter -->
                </div>
                <!-- /.col -->

                <div class="col-3 pb-1">
                    <h6 class="color-dark text-uppercase text-center">Заказов</h6>

                    <div class="counter m-2">
                        <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                            <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                            <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_zakaz; ?>, 100" stroke-dashoffset="<?= $procent_zakaz; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                        </svg>
                        <div class="counter__value"><span><?= $count_request_zakaz; ?></span></div>
                    </div>
                    <!-- /.counter -->
                </div>
                <!-- /.col -->

                <div class="col-3 pb-1">
                    <h6 class="color-dark text-uppercase text-center">Писем</h6>

                    <div class="counter m-2">
                        <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                            <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                            <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_message; ?>, 100" stroke-dashoffset="<?= $procent_message; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                        </svg>
                        <div class="counter__value"><span><?= $count_message_not_read; ?></span></div>
                    </div>
                    <!-- /.counter -->
                </div>
                <!-- /.col -->

                <div class="col-3 pb-1">
                    <h6 class="color-dark text-uppercase text-center">Задач</h6>

                    <div class="counter m-2">
                        <svg class="counter__circle" viewBox="0 0 35 35" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;">
                            <circle class="counter__background" stroke="transparent" stroke-width="1" fill="none" stroke-linecap="round" stroke-dasharray="100,100" cx="17.5" cy="17.5" r="15.91549431"/>
                            <circle class="counter__circle-value" stroke="#000000" stroke-width="1" stroke-dasharray="<?= $procent_task; ?>, 100" stroke-dashoffset="<?= $procent_task; ?>" stroke-linecap="round" fill="none" cx="17.5" cy="17.5" r="15.91549431" />
                        </svg>

                        <div class="counter__value"><span><?= $count_task_not_read; ?></span></div>
                    </div>
                    <!-- /.counter -->

                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-header -->


    <section class="sec sec-negative">

        <div class="container container-xs px-0">

            <div class="card">

                <div class="card-body">

                    <div class="media">

                        <div class="media-body">

                            <div class="row flex-nowrap">

                                <div class="col-auto">
                                    <h4>Текущий баланс</h4>
                                    <p class="card-number"><b><?= $balance; ?> ₽</b></p>
                                    <h4>Текущих заказов</h4>
                                    <p class="card-number"><b><?= $count_request_zakaz; ?></b></p>
                                    <a href="#" class="btn btn-sm btn-primary">выполнить</a>
                                </div>
                                <!-- /.col -->

                                <div class="col">

                                    <form novalidate class="form card-switcher text-right">

                                        		<span class="switch switch-sm">
                                    <input type="checkbox" class="switch" id="switch-sm" checked>
                                    <label for="switch-sm"></label>
                                  </span>
                                        <!-- /.switch -->

                                    </form>
                                    <!-- /.form -->

                                    <div class="chart card-chart ml-auto mr-auto mt-n3" id="chart"></div>
                                    <!-- /.chart -->

                                </div>
                                <!-- /.col-auto -->

                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.media-body -->

                    </div>
                    <!-- /.media -->

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-negative -->


    <section class="sec sec-breadcrumbs">

        <div class="container container-xs px-0">

            <div class="row">

                <div class="col">

                    <div class="breadcrumbs ml-3">
                        <ul>
                            <li>
                                <a href="/web/">Мои замеры</a>
                            </li>
                            <li>
                                <a href="/web/">Новый заказ</a>
                            </li>
                            <li>
                                <span>Выбор даты</span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.breadcrumbs -->

                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>
    <!-- /.sec-breadcrumbs -->

    <section class="sec sec-main">

        <section class="sec sec-breadcrumbs" data-sticky-breadcrumbs>

            <div class="container container-xs px-0">

                <div class="row">

                    <div class="col">

                        <div class="breadcrumbs ml-3">
                            <ul>
                                <li>
                                    <a href="">Мои замеры</a>
                                </li>
                                <li>
                                    <span>Новый заказ</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.breadcrumbs -->

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->

        </section>
        <!-- /.sec-breadcrumbs -->


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </section>
</div>



<?php Pjax::end(); ?>



<!-- footer-->

<!-- TAB BAR -->
<nav class="tab-bar tab-bar-bottom">
    <div class="container container-xs px-0">
        <div class="row flex-nowrap">
            <div class="col">
                <a href="" class="tab-bar__btn">
                    <span class="tab-bar__label">мои заказы</span>
                    <svg class="tab-bar__icon svg-add-to-basket" width="31" height="31">
                        <use xlink:href="/web/img/svg/sprite.svg#add-to-basket"></use>
                    </svg>
                </a>
            </div>
            <div class="col">
                <a href="" class="tab-bar__btn active">
                    <span class="tab-bar__label">уведомления</span>
                    <svg class="tab-bar__icon svg-browser" width="31" height="31">
                        <use xlink:href="/web/img/svg/sprite.svg#browser"></use>
                    </svg>
                </a>
            </div>
            <div class="col">
                <a href="" class="tab-bar__btn">
                    <span class="tab-bar__label">чат</span>
                    <svg class="tab-bar__icon svg-mail" width="37" height="31">
                        <use xlink:href="/web/img/svg/sprite.svg#mail"></use>
                    </svg>
                </a>
            </div>
            <div class="col">
                <a href="" class="tab-bar__btn">
                    <span class="tab-bar__label">новые заказы</span>
                    <svg class="tab-bar__icon svg-pencil-rule" width="31" height="31">
                        <use xlink:href="/web/img/svg/sprite.svg#pencil-rule"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- END TAB BAR -->

</main>
<!-- /.wrap-container -->
