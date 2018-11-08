<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



$breadcrumbs = new \common\models\Breadcrumbs();
$this->params['breadcrumbs'] = $breadcrumbs->construct($model->cat_ids);
?>

<div class="article_view">

    <?php if ($model->view) : ?>
        <?= $this->render('part_views/article/'.$model->view, [
            'article' => $model,
        ]) ?>
    <?php endif; ?>


    <?php if (!$model->view) : // если вюхи нет  ?>
        <?php $article = $model; ?>
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
                <section class="<?= $section->color_key ?> <?= $section->custom_class ?>">
                    <?php if ($section->header) : ?>
                        <h2 class="<?= $section->header_class ?>"><?= $section->header ?></h2>
                    <?php endif; ?>
                    <?php if ($section->description) : ?>
                        <h3 class="text-center"><?= $section->description ?></h3>
                    <?php endif; ?>
                    <?php if ($section->raw_text) : ?>
                        <p><?= nl2br($section->raw_text)  ?></p>
                    <?php endif; ?>
                    <?php if ($section->blocks) : ?>
                        <?php foreach ($section->blocks as $block) : ?>
                            <?php if ($block->view) : ?>
                                <?= $this->render($block->view, [
                                    'model' => $block,
                                ]) ?>
                            <?php endif; ?>
                            <?php if (!$block->view) : ?>
                                <?php if ($block->header) : ?>
                                    <h4 class="<?= $block->header_class ?>"><?= $block->header ?></h4>
                                <?php endif; ?>
                                <?php if ($block->description) : ?>
                                    <p class="text-center"><?= $block->description ?></p>
                                <?php endif; ?>
                                <?php if ($block->items) : ?>
                                    <?php foreach ($block->items as $item) : ?>
                                        <?php if ($item->header) : ?>
                                            <p class="<?= $item->header_class ?>"><?= $item->header ?></p>
                                        <?php endif; ?>
                                        <?php if ($item->description) : ?>
                                            <p class="text-center"><?= $item->description ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

