<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$preorderForm = new \common\models\Preorders();

?>
<div class="a-page_preorder_form">
    <?= Alert::widget() ?>
    <h1 class="text-center"><?= Html::encode($article->h1) ?></h1>

    <?php if ($article->exerpt) : ?>
        <p><?= $article->exerpt ?></p>
    <?php endif; ?>
    <?php if ($article->exerpt_big) : ?>
        <p><?= $article->exerpt_big ?></p>
    <?php endif; ?>

    <?php if ($article->raw_text) : ?>
        <p><?= nl2br($article->raw_text)  ?></p>
    <?php endif; ?>

    <?php if ($article->sections) : ?>
        <?php foreach ($article->sections as $section) : ?>
            <?php if ($section->view) : ?>
                <?= $this->render('/article/part_views/section/'.$section->view, [
                    'model' => $section,
                ]) ?>
            <?php endif; ?>
            <?php if (!$section->view) : ?>
                <section <?php
                if ($section->color_key || $section->custom_class) {

                    echo 'class="';
                    echo $section->color_key;
                    echo ' ';
                    echo $section->custom_class;
                    echo '"';

                }
                ?>>
                    <?php if ($section->header) : ?>
                        <h2 <?= $section->header_class?'class="'.$section->header_class.'"':null ?>><?= nl2br($section->header) ?></h2>
                    <?php endif; ?>
                    <?php if ($section->description) : ?>
                        <p <?= $section->description_class?'class="'.$section->description_class.'"':null ?>><?= nl2br($section->description) ?></p>
                    <?php endif; ?>
                    <?php if ($section->raw_text) : ?>
                        <p><?= nl2br($section->raw_text)  ?></p>
                    <?php endif; ?>
                    <?php if ($section->blocks) : ?>
                        <?php foreach ($section->blocks as $block) : ?>
                            <div class="a-page_preorder_form-block_default <?= $block->color_key ?> <?= $block->custom_class ?>">
                                <?php if ($block->view) : ?>
                                    <?= $this->render('/article/part_views/block/'.$block->view, [
                                        'model' => $block,
                                    ]) ?>
                                <?php endif; ?>
                                <?php if (!$block->view) : ?>
                                    <?php if ($block->header) : ?>
                                        <h4 <?= $block->header_class?'class="'.$block->header_class.'"':null ?>><?= nl2br($block->header) ?></h4>
                                    <?php endif; ?>
                                    <?php if ($block->description) : ?>
                                        <p <?= $block->description_class?'class="'.$block->description_class.'"':null ?>><?= nl2br($block->description) ?></p>
                                    <?php endif; ?>
                                    <?php if ($block->raw_text) : ?>
                                        <p <?= $block->raw_text_class?'class="'.$block->raw_text_class.'"':null ?>><?= nl2br($block->raw_text) ?></p>
                                    <?php endif; ?>
                                    <?php if ($block->items) : ?>
                                        <?php foreach ($block->items as $item) : ?>
                                            <?php if ($item->header) : ?>
                                                <p <?= $item->header_class?'class="'.$item->header_class.'"':null ?>><?= nl2br($item->header) ?></p>
                                            <?php endif; ?>
                                            <?php if ($item->description) : ?>
                                                <p <?= $item->description_class?'class="'.$item->description_class.'"':null ?>><?= nl2br($item->description) ?></p>
                                            <?php endif; ?>
                                            <?php if ($item->text) : ?>
                                                <p <?= $item->text_class?'class="'.$item->text_class.'"':null ?>><?= nl2br($item->text) ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
           
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="text-center">
        <?= Html::a('Оформить заявку', '#orderForm',['class' => 'btn btn-primary order-btn mt10 mb20', 'data-toggle'=>'collapse']) ?>
    </div>

    <div class="feedback-form panel-collapse collapse" id="orderForm">
        <?php $form = ActiveForm::begin([
            'action' =>['site/order'],
            'id' => 'order-form',
            'method' => 'post',]); ?>
        <!--    --><?php //$form = ActiveForm::begin(['action' =>['site/ordercaptcha'], 'method' => 'post',]); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'dispatch')
                    ->textInput(['required' => true,'id' => 'preorder_form-dispatch'])->label('Откуда') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'destination')
                    ->textInput(['required' => true,'id' => 'preorder_form-destination'])->label('Куда') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'phone')
                    ->textInput(['required' => true,'id' => 'preorder_form-phone']) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'email')
                    ->textInput(['maxlength' => true,'id' => 'preorder_form-email']) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'cargo')
                    ->textInput(['required' => true,'id' => 'preorder_form-cargo'])->label('Характер груза')  ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($preorderForm, 'weight')
                    ->textInput(['maxlength' => true,'id' => 'preorder_form-weight'])->label('Вес')  ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($preorderForm, 'text')
                    ->textarea(['rows' => 1,'id' => 'preorder_form-text'])->label('Комментарий') ?>
            </div>
            <!--        captcha -->
            <!--        <div class="col-sm-12"> --><?//= $form->field($preorderForm, 'captcha')->widget(Captcha::className()) ?><!--</div>-->

            <?= $form->field($preorderForm, 'from_page')
                ->hiddenInput(['value'=>$article->hrurl ,'id' => 'preorder_form-from_page'])->label(false) ?>

            <?= $form->field($preorderForm, 'utm_source')
                ->hiddenInput([ 'id' => 'preorder_form-utm_source'])->label(false) ?>
            <?= $form->field($preorderForm, 'utm_medium')
                ->hiddenInput([ 'id' => 'preorder_form-utm_medium'])->label(false) ?>
            <?= $form->field($preorderForm, 'utm_campaign')
                ->hiddenInput([ 'id' => 'preorder_form-utm_campaign'])->label(false) ?>
            <?= $form->field($preorderForm, 'utm_term')
                ->hiddenInput([ 'id' => 'preorder_form-utm_term'])->label(false) ?>
            <?= $form->field($preorderForm, 'utm_content')
                ->hiddenInput([ 'id' => 'preorder_form-utm_content'])->label(false) ?>

            <div class="col-sm-6 col-sm-offset-3 text-center">
                <?= Html::submitButton('отправить заявку', ['class' => 'btn btn-primary sendorder-btn mt10']) ?>
            </div>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>
