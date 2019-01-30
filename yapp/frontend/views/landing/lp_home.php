<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
//use \yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
//$this->title = 'Page View';
//$this->params['breadcrumbs'][] = $this->title;

$feedback = new common\models\Preorders();
$preorder = new common\models\Preorders();
?>




<?= $this->render('/layouts/navbar', ['onDark'=>true]) ?>







<div class="container ">


    <!--   dark top-->
    <section id="topSection"
             class="<?= $sections['top']['stylekey'] ?> <?= $sections['top']['section_type'] ?>"
             style=" background-image: url(/img/<?= $sections['top']['image'] ?>)">
        <div id="topLoopBg" class="topBackImage"></div>
        <?= common\widgets\Alert::widget() ?>
        <div class="row">
            <div class="col-sm-9  text-center">
                <div class="col-sm-12">
                    <p class="head c_def"><?= $sections['top']['head'] ?></p>
                </div>
                <div class="col-sm-12">
                    <p class="lead c_def"><?= nl2br($sections['top']['lead']) ?></p>
                </div>
            </div>
            <div id="divTopForm" class="col-sm-3 topForm text-center">
                <?php $form = ActiveForm::begin([
                    'id' => 'quickorder_form_top',
                    'method' => 'post',
                    'action' => ['/site/order'],

                ]); $preorder = new \common\models\Preorders(); ?>

                <?= Html::errorSummary($preorder, ['class' => 'errors']) ?>

                <?= $form->field($preorder, 'operation_id')
                    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-operation_id'])
                    ->label('№ процедуры и площадка') ?>

                <?= $form->field($preorder, 'inn')
                    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-inn']) ?>

                <?= $form->field($preorder, 'name')
                    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-name']) ?>

                <?= $form->field($preorder, 'phone')
                    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-phone']) ?>

                <?= $form->field($preorder, 'email')
                    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-email']) ?>


                <?= $form->field($preorder, 'utm_source')
                    ->hiddenInput(['value'=>$utm['source'], 'id' => 'quickorder_form_top-utm_source'])->label(false) ?>
                <?= $form->field($preorder, 'utm_medium')
                    ->hiddenInput(['value'=>$utm['medium'], 'id' => 'quickorder_form_top-utm_medium'])->label(false) ?>
                <?= $form->field($preorder, 'utm_campaign')
                    ->hiddenInput(['value'=>$utm['campaign'], 'id' => 'quickorder_form_top-utm_campaign'])->label(false) ?>
                <?= $form->field($preorder, 'utm_term')
                    ->hiddenInput(['value'=>$utm['term'], 'id' => 'quickorder_form_top-utm_term'])->label(false) ?>
                <?= $form->field($preorder, 'utm_content')
                    ->hiddenInput(['value'=>$utm['content'], 'id' => 'quickorder_form_top-utm_content'])->label(false) ?>

                <?= $form->field($preorder, 'service_type')
                    ->hiddenInput(['value'=>'bank_garant','id' => 'quickorder_form_top-service_type'])->label(false) ?>
                <?= $form->field($preorder, 'site')
                    ->hiddenInput(['value'=>'finlider.ru','id' => 'quickorder_form_top-site'])->label(false) ?>
                <?= $form->field($preorder, 'from_page')
                    ->hiddenInput(['value'=>'home','id' => 'quickorder_form_top-from_page'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Получить гарантию', ['class' => 'btn btn-danger']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

            </div>
        </div>

    </section>

<!--    1 undertop -->
    <section id="undertopSection"
             class="<?= $sections['undertop']['stylekey'] ?> <?= $sections['undertop']['section_type'] ?>">
        <div class="row">
            <div class="col-sm-12  text-center mb50">
                <h1 class="head"><?= $sections['undertop']['head'] ?></h1>
            </div>
            <div class="col-sm-8 col-sm-offset-2 text-left">
                <p class="head"><?= nl2br($sections['undertop']['text']) ?></p>
            </div>
        </div>
    </section>


    <!--Услуги-->
    <section id="servicesSection"
             class="<?= $sections['services']['stylekey'] ?> <?= $sections['services']['section_type'] ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="head"><?= $sections['services']['head'] ?></h2>
            </div>
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <p ><?= nl2br($sections['services']['text']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 text-center">
                <div class="service_type_icon">
                    <?= $sections['services']['list_items'][0]['image'] ?>
                </div>
                <div class="service_type_head">
                    <?= nl2br($sections['services']['list_items'][0]['head']) ?>
                </div>
                <div class="service_type_text">
                    <?= nl2br($sections['services']['list_items'][0]['text']) ?>
                </div>
                <div class="service_type_button">
                    <?= Html::a('Подробнее','/tender_zaim',['class'=>'btn btn-danger']) ?>
                </div>

            </div>
            <div class="col-sm-6 text-center">
                <div class="service_type_icon">
                    <?= $sections['services']['list_items'][1]['image'] ?>
                </div>
                <div class="service_type_head">
                    <?= nl2br($sections['services']['list_items'][1]['head']) ?>
                </div>
                <div class="service_type_text">
                    <?= nl2br($sections['services']['list_items'][1]['text']) ?>
                </div>
                <div class="service_type_button">
                    <?= Html::a('Подробнее','/bank_garant',['class'=>'btn btn-danger']) ?>
                </div>
            </div>


        </div>

        <div class="smooth_angle"
            style=" background-image: url(/img/slim_angle_to_bottom_right.svg)"
            >
        </div>

    </section>



    <!-- Почему мы -->
    <section id="whyWeSection"
             class="<?= $sections['whyWe']['stylekey'] ?> <?= $sections['whyWe']['section_type'] ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="head c_def"><?= nl2br($sections['whyWe']['head']) ?></h2>
            </div>
            <div class="row">

                <div class="col-sm-10 col-sm-offset-2 mt30">
                    <?php foreach ($sections['whyWe']['list_items'] as $listItem ) : ?>
                        <div class="row mt10 listItem">
                            <div class="col-xs-3  col-sm-2 text-center">
                                <div class="whyWe_icon">
                                    <?= $listItem ['image'] ?>
                                </div>
                            </div>
                            <div class="col-xs-9 col-sm-8 less480noPl noPl c_def ">
                                <div class="whyWe_head">
                                    <?= $listItem ['head'] ?>
                                </div>
                                <div class="whyWe_text">
                                    <?= $listItem ['text'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-12 text-center ">
                    <?php $form = ActiveForm::begin([
                        'action' => ['/site/order'],
                        'id' => 'whyWe_call2action',
                        'method' => 'post',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
//                    'label' => 'col-sm-4',
                                'offset' => 'col-sm-offset-3 col-lg-offset-4',
                                'wrapper' => 'col-sm-6 col-lg-4',
//                    'error' => '',
//                    'hint' => 'телефон',
                            ],
                        ],
                    ]); ?>

                    <?php $feedback = $preorder ?>
                    <?= Html::errorSummary($feedback, ['class' => 'errors']) ?>
                    <?= $form->field($feedback, 'name')
                        ->hiddenInput([
                            'value'=>'Секция - Как мы работаем - Рассчитать стоимость',
                            'id' => 'whyWe_call2action-name'
                        ])
                        ->label(false) ?>
                    <?= $form->field($feedback, 'from_page')
                        ->hiddenInput(['value'=>$page ['hrurl'],'id' => 'whyWe_call2action-from_page'])
                        ->label(false) ?>

                    <?= $form->field($feedback, 'utm_source')
                        ->hiddenInput(['value'=>$utm['source'], 'id' => 'whyWe_call2action-utm_source'])
                        ->label(false) ?>
                    <?= $form->field($feedback, 'utm_medium')
                        ->hiddenInput(['value'=>$utm['medium'], 'id' => 'whyWe_call2action-utm_medium'])
                        ->label(false) ?>
                    <?= $form->field($feedback, 'utm_campaign')
                        ->hiddenInput(['value'=>$utm['campaign'], 'id' => 'whyWe_call2action-utm_campaign'])
                        ->label(false) ?>
                    <?= $form->field($feedback, 'utm_term')
                        ->hiddenInput(['value'=>$utm['term'], 'id' => 'whyWe_call2action-utm_term'])
                        ->label(false) ?>
                    <?= $form->field($feedback, 'utm_content')
                        ->hiddenInput(['value'=>$utm['content'], 'id' => 'whyWe_call2action-utm_content'])
                        ->label(false) ?>

                    <?= $form->field($feedback, 'phone', [
                        'inputOptions' => ['placeholder' => 'ТЕЛЕФОН'],
                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.
                            '<button type="submit" class="btn btn-submit">'.
                            $sections['whyWe']['call2action_name'].
                            '</button></span></div>',
                    ])
                        ->textInput(['maxlength' => true,'id' => 'whyWe_call2action-phone'])
                        ->label(false) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </section>

    <!--    call2action -->
    <section id="call2actionSection"
             class="<?= $sections['call2action']['stylekey'] ?> <?= $sections['call2action']['section_type'] ?>">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-left">
                <p class="head text-center mb50"><?= nl2br($sections['call2action']['text']) ?></p>
            </div>
        </div>
    </section>
    <!--    Reviews   -->

    <section
        id="reviewsSection"
        class="<?= $sections['reviews']['stylekey'] ?> <?= $sections['reviews']['section_type'] ?>">





<!--        <div class="row">-->
<!--            <div class="col-sm-12 text-center">-->
<!--                <h2 class="head">--><?//= $sections['reviews']['head'] ?><!--</h2>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="reviewsCarWrapper ">-->
<!--            <div class="reviewsCarousel text-center">-->
<!--                --><?php //foreach ($sections['reviews']['list_items'] as $review) : ?>
<!--                    <div class="review_item">-->
<!---->
<!--                        <a class="caruMagLink" href="/img/--><?//= $review['image'] ?><!--"><img src="/img/th_--><?//= $review['image'] ?><!--" alt="--><?//= $review['image_alt'] ?><!--" /></a>-->
<!---->
<!--                    </div>-->
<!---->
<!--                --><?php //endforeach; ?>
<!---->
<!--            </div>-->
<!--            <a class="carouselControl slickReviewsPrev"><svg version="1.1"-->
<!--                                                             xmlns="http://www.w3.org/2000/svg"-->
<!--                                                             xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                                                             x="0px" y="0px"-->
<!--                                                             viewBox="0 0 90 90"-->
<!--                                                             style="enable-background:new 0 0 90 90;"-->
<!--                                                             xml:space="preserve">-->
<!--<style type="text/css">-->
<!--    .control_circle_left_st0{fill:none;stroke-width:2;stroke-miterlimit:10;}-->
<!--    .control_circle_left_st1{fill:none;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}-->
<!--</style>-->
<!--                    <g >-->
<!--                        <circle  class="control_circle_left_st0" cx="45" cy="45" r="38.4"/>-->
<!--                        <g >-->
<!--                            <line  class="control_circle_left_st1" x1="47.1" y1="22.3" x2="36.5" y2="45"/>-->
<!--                            <line  class="control_circle_left_st1" x1="36.5" y1="45" x2="47.1" y2="67.7"/>-->
<!--                        </g>-->
<!--                    </g>-->
<!--</svg></a>-->
<!---->
<!--            <a class="carouselControl slickReviewsNext" ><svg version="1.1"-->
<!--                                                              xmlns="http://www.w3.org/2000/svg"-->
<!--                                                              xmlns:xlink="http://www.w3.org/1999/xlink"-->
<!--                                                              x="0px" y="0px"-->
<!--                                                              viewBox="0 0 90 90"-->
<!--                                                              style="enable-background:new 0 0 90 90;"-->
<!--                                                              xml:space="preserve">-->
<!--<style type="text/css">-->
<!--    .control_circle_right_st0{fill:none;stroke-width:2;stroke-miterlimit:10;}-->
<!--    .control_circle_right_st1{fill:none;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}-->
<!--</style>-->
<!--                    <g >-->
<!--                        <circle  class="control_circle_right_st0" cx="45" cy="45" r="38.4"/>-->
<!--                        <g >-->
<!--                            <line  class="control_circle_right_st1" x1="42.9" y1="22.3" x2="53.5" y2="45"/>-->
<!--                            <line  class="control_circle_right_st1" x1="53.5" y1="45" x2="42.9" y2="67.7"/>-->
<!--                        </g>-->
<!--                    </g>-->
<!--</svg></a></div>-->
<!---->



<!--        <div class="row mt100">-->
        <div class="row ">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="col-xs-6 text-center">
                    <div class="col-sm-12">
                        <a class="reviewLink" href="/tender_zaim"><svg version="1.1" id="tender_zaim_svg_mid"
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px"
                                        viewBox="0 0 100 85"
                                        style="enable-background:new 0 0 100 85;"
                                        xml:space="preserve">
<style type="text/css">
    .tender_zaim_svg_mid_st0{fill:#FFFFFF;}
</style>
                                <g >
                                    <g >
                                        <path  class="tender_zaim_svg_mid_st0" d="M30.9,81L4.3,54.4l8.9-8.9l26.6,26.6L30.9,81z M5.7,54.4l25.2,25.2l7.5-7.5L13.2,46.9
			L5.7,54.4z"/>
                                        <path  class="tender_zaim_svg_mid_st0" d="M65.5,54.2h-16v-1h16c2.5,0,4.6-2.1,4.6-4.6S68.1,44,65.5,44H55.2l-2.5-2.5
			c-1.5-1.5-3.5-2.3-5.6-2.3H36c-2.2,0-4.3,0.8-5.9,2.1l-12.3,10l-0.6-0.8l12.3-10c1.8-1.5,4.2-2.3,6.6-2.3h11.1
			c2.4,0,4.6,0.9,6.3,2.6l2.2,2.2h9.9c3.1,0,5.6,2.5,5.6,5.6S68.6,54.2,65.5,54.2z"/>
                                        <path  class="tender_zaim_svg_mid_st0" d="M35.7,69l-0.4-0.9l3.3-1.5c1.4-0.6,2.9-0.9,4.4-0.9h22.8c1.8,0,3.5-0.8,4.8-2.1l22.9-24.8
			c1.9-2,1.8-5.1-0.1-7c-2-2-5.2-2-7.2,0L70.5,47.2l-0.7-0.7L85.3,31c2.4-2.4,6.2-2.4,8.6,0c2.3,2.3,2.4,6,0.2,8.4L71.2,64.2
			c-1.4,1.5-3.4,2.4-5.5,2.4H42.9c-1.4,0-2.7,0.3-4,0.9L35.7,69z"/>
                                    </g>
                                    <g >
                                        <rect  x="53.1" y="13.7" class="tender_zaim_svg_mid_st0" width="7.4" height="22.1"/>
                                        <circle  class="tender_zaim_svg_mid_st0" cx="56.6" cy="7.6" r="3.7"/>
                                        <rect  x="64.1" y="24.7" class="tender_zaim_svg_mid_st0" width="7.4" height="11"/>
                                        <circle  class="tender_zaim_svg_mid_st0" cx="67.9" cy="18.7" r="3.7"/>
                                        <rect  x="42" y="24.7" class="tender_zaim_svg_mid_st0" width="7.4" height="11"/>
                                        <circle  class="tender_zaim_svg_mid_st0" cx="45.7" cy="18.7" r="3.7"/>
                                    </g>
                                </g>
</svg></a>
                    </div>
                    <div class="col-sm-12">
                        <?= Html::a('Получить тендерный займ','/tender_zaim',['class'=>'goLink']) ?>
                    </div>
                </div>
                <div class="col-xs-6 text-center">
                    <div class="col-sm-12">
                        <a class="reviewLink" href="/bank_garant"><svg version="1.1" id="bank_ganrantee_svg_mid"
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px"
                                        viewBox="0 0 100 85"
                                        style="enable-background:new 0 0 100 85;"
                                        xml:space="preserve">
<style type="text/css">
    .bank_ganrantee_svg_mid_st0{fill:#FFFFFF;}
</style>
                                <path class="bank_ganrantee_svg_mid_st0" d="M77.8,30.9H7.6v-3.8L42.7,7.4l35.1,19.8V30.9z M8.6,29.9h68.2v-2.2L42.7,8.5L8.6,27.8V29.9z
	 M42.7,26.8c-3.1,0-5.6-2.5-5.6-5.6s2.5-5.6,5.6-5.6c3.1,0,5.6,2.5,5.6,5.6S45.8,26.8,42.7,26.8z M42.7,16.6c-2.5,0-4.6,2.1-4.6,4.6
	s2.1,4.6,4.6,4.6s4.6-2.1,4.6-4.6S45.3,16.6,42.7,16.6z"/>
                                <g>
                                    <path  class="bank_ganrantee_svg_mid_st0" d="M77.7,77.1c-0.2,0-0.3,0-0.5-0.1c-13.5-4.6-13.8-17.2-14.1-27.4l0-1.5l1.5,0.1
		c0,0,1.4,0,2.6-0.8c1.1-0.7,1.8-1.9,2-3.5l0.1-1l1-0.2c4.5-0.9,9.5-0.9,14.6,0l1,0.2l0.1,1.1c0.2,1.6,0.9,2.8,2,3.5
		c1.2,0.8,2.6,0.8,2.6,0.8l1.5,0l0,1.5C92.1,59.8,91.7,72.5,78.3,77C78.1,77.1,77.9,77.1,77.7,77.1C77.8,77.1,77.8,77.1,77.7,77.1z
		 M66.1,50.9c0.4,11,1.7,19.6,11.7,23.2c10-3.6,11.3-11.9,11.7-23.2c-0.6-0.1-1.3-0.3-2-0.7c-0.1,0-0.1-0.1-0.2-0.1l0,0L86.9,50
		c0,0,0,0,0,0c0,0,0,0,0,0l-0.5-0.3l0,0c-1.1-0.8-2.3-2.1-2.8-4.3c-4-0.6-8-0.6-11.6,0c-0.6,2.5-2,3.8-3.1,4.5
		C67.9,50.5,66.9,50.8,66.1,50.9z"/>
                                    <path class="bank_ganrantee_svg_mid_st0" d="M77.8,45.6v27.5c0,0-9-2.9-10.2-13.6h20.3c0,0,0.8-4,0.6-8c0,0-5.1-1.6-5.5-5.5
		C83,46.1,80.1,45.5,77.8,45.6z"/>
                                </g>
                                <g>
                                    <path class="bank_ganrantee_svg_mid_st0" d="M73.7,76H8.9v-5h7V35.7h-7v-2h67.7v2h-7.7V44c0-0.1,0.1-0.3,0.1-0.4l0.1-1l0.8-0.2v-5.7h7.7v-4
		H7.9v4h7V70h-7v7h68C75.1,76.7,74.3,76.3,73.7,76z"/>
                                    <path class="bank_ganrantee_svg_mid_st0" d="M58.4,71V35.7H47.9V71H58.4z M48.9,36.7h8.5V70h-8.5V36.7z"/>
                                    <path class="bank_ganrantee_svg_mid_st0" d="M37.5,71V35.7H26.3V71H37.5z M27.3,36.7h9.3V70h-9.3V36.7z"/>
                                </g>
</svg></a>
                    </div>
                    <div class="col-sm-12">
                        <?= Html::a('Получить банковскую гарантию','/bank_garant',['class'=>'goLink']) ?>
                    </div>

                </div>
            </div>

        </div>


    </section>



