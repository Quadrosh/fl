<?php


?>
<div class="contact_page">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1 text-left">
            <h4 class="head">АДРЕС</h4>
            <p><?= Yii::$app->params['fullAddress'] ?></p>
        </div>
        <div class="col-sm-5  text-left">
            <h4 class="head">СВЯЗАТЬСЯ С НАМИ</h4>
            <p>Отдел продаж: тел: <?= Yii::$app->params['mainPhone']  ?></p>
        </div>

    </div>
    <div class="row mt50">
        <div class="col-sm-10 col-sm-offset-1 mapDiv">

            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ae5699d77885a1a8b9b1c1c8fd68a6fb097e5f24574f9d898edfd718a1bb50756&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </div>


</div>
