<?php
use yii\helpers\Html;
?>

<div class="metering-default-index">


    <?php print(Html::a('<img src="/web/uploads/images/mobile/item-request.jpg"> Новые заказы', ['/metering/default/new-request']));?>
    </br><?php print(Html::a('<img src="/web/uploads/images/mobile/item-request.jpg"> Мои заказы', ['/metering/default/my-request']));?>
    </br><?php print(Html::a('<img src="/web/uploads/images/mobile/item-request.jpg"> Отклики', ['/metering/default/my-response']));?>

</div>
