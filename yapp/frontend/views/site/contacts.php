<?php


?>
<div class="contact_page">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2 text-left">
            <h4 class="head"><?= $page['pagehead'] ?></h4>
            <p><?= nl2br($page['pagedescription'])  ?></p>
        </div>
        <div class="col-sm-5  text-left">
            <h4 class="head"><?= $page['imagelink'] ?></h4>
            <p><?= nl2br($page['text'])  ?></p>
        </div>

    </div>
    <div class="row mt50">
        <div class="col-sm-10 col-sm-offset-1 mapDiv">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af2f1ee1139b0d0f6d91b9650d13086b915583a4e8ab70e8050874aa46e240dad&amp;height=500&amp;lang=ru_RU"></script>
        </div>
    </div>


</div>
