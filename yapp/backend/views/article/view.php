<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */

$uploadmodel = new \common\models\UploadForm();


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Export', ['/article/export', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Точно уже экспортировать статью?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>
        <?= Html::a('Создать категорию', ['/menu/create',
            'url'=>$model->hrurl,
            'name'=>$model->list_name], ['class' => 'btn btn-success btn-xs']) ?>
        <?= Html::a('Создать страницу', ['/pages/create',
            'hrurl'=>$model->hrurl,
            'status'=>'article'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'site',
            'id',
            'list_name',
            [
                'attribute'=>'cat_ids',
                'value' => function($model)
                {
                    $rawIds = $model['cat_ids'];
                    $out='';
                    $ids = json_decode($rawIds);
                    $i=0;
                    if ($ids) {
                        foreach ($ids as $id) {
                            $cat=\common\models\Menu::find()->where(['id'=>$id])->one();
                            if (isset($cat)) {
                                if ($cat->tree==0) {
                                    $cat->tree=1;
                                }
                                $menu=\common\models\Menu::find()->where(['id'=>$cat->tree])->one();
                                $out .=$menu->name.'->'.$cat->name;
                                if (count($ids)-1>$i) {
                                    $out .=', ';
                                }
                                $i++;
                            }
                        }

                    }
                    return $out;
                },
                'format'=> 'html',
                'label'=> 'Категории в каталоге',
            ],
            [
                'attribute'=>'hrurl',
                'value' => function($data)
                {

                    $startUrl = $data->status == 'page'? '/':'/article/';

                    if (Yii::$app->request->getHostName() == 'cp.finlider.local') {
                        $lpSite = $data['site'];
                        $localSite = str_replace('.ru','.local',$lpSite);
                        return '<a  href="http://'.$localSite.$startUrl.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    } else {
                        return '<a  href="http://'.$data['site'].$startUrl.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    }


                },
                'format'=> 'html',
            ],
            'title',
            'description:ntext',
            'keywords:ntext',
            'exerpt:ntext',
            'exerpt_big:ntext',
            'h1',
            'topimage',
            'topimage_alt',
            'background_image:ntext',
            'thumbnail_image:ntext',
            'call2action_description',
            'call2action_name',
            'call2action_link',
            'call2action_class',
            'call2action_comment',
            'imagelink',
            'imagelink_alt',
            'author',
            'status',
            'view',
            'layout',
            [
                'attribute'=>'created_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['created_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],
            [
                'attribute'=>'updated_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['updated_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],

        ],
    ]) ?>


    <section>
            <div class="row">
                <div class="col-sm-12">
                    <?php if ($model->topimage) : ?>
                    <h4>Article topimage</h4>
                    <?= Html::img('/img/'. $model->topimage, ['class'=>'img']) ?>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12">
                    <?php if ($model->background_image) : ?>
                        <h4>Article background_image</h4>
                        <?= Html::img('/img/'. $model->background_image, ['class'=>'img']) ?>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12">
                    <?php if ($model->thumbnail_image) : ?>
                        <h4>Article thumbnail_image</h4>
                        <?= Html::img('/img/'. $model->thumbnail_image, ['class'=>'img']) ?>
                    <?php endif; ?>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <h4>Image Upload</h4>
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['/article/upload'],
                        'options' => ['enctype' => 'multipart/form-data'],
                    ]); ?>
                    <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                        'topimage'=>'Top Image',
                        'background_image'=>'Background Image',
                        'thumbnail_image'=>'Thumbnail Image',
                        'imagelink'=>'Imagelink',
                    ])->label(false) ?>
                    <?= $form->field($uploadmodel, 'imageFile')->fileInput(['class'=>'fileField'])->label(false) ?>
                    <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>
                    <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end() ?>
                </div>
            </div>

    </section>

    <?= Html::a('Добавить секцию','/article-section/create?article_id='.$model->id, ['class' => 'mt50 btn btn-success']) ?>

    <section class="mt50 article-sections">



<?php if ($model->sections) : ?>
    <ol class="breadcrumb">
        <li>Управление - секции <?php if ($model->view) {echo ' | article view => '.$model->view;} ?> </li>
    </ol>
    <?php $sectionNum=1; foreach ($model->sections as $section) : ?>
        <div class="row admin_section_head">
            <div class="col-sm-4">
                Секция: <?= $sectionNum ?>. <?= $section->sort?'<sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$section->sort:'' ?> <span class="text-danger"><?= $section->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section/update?id='.$section->id,
                    [
                        'title' => Yii::t('yii', 'Редактировать секцию'),
                        'data-method'=>'post'
                    ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-open-file"></span>', '/article-section-block/create?section_id='.$section->id,
                    [
                        'title' => Yii::t('yii', 'Добавить блок'),
                        'data-method'=>'post'
                    ]); ?>
                <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section/delete?id='.$section->id,
                    [
                        'title' => Yii::t('yii', 'Удалить секцию'),
                        'data-confirm' =>'Точно удалить секцию со всеми блоками и block items?',
                        'data-method'=>'post'
                    ]); ?>
            </div>
            <div class="col-sm-8">
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/article-section/upload'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                            'section_image'=>'Section Image',
                            'background_image'=>'Background Image',
                            'thumbnail_image'=>'Thumbnail Image',

                        ])->label(false) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($uploadmodel, 'imageFile')
                            ->fileInput(['class'=>'fileField'])->label(false) ?>
                        <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$section->id])->label(false) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>

        <ul class="admin_section_ul">
            <li>ID - <?= $section->id ?><?= $section->sort?', Sort - '.$section->sort:'' ?></li>
            <?= $section->header?'<li> Header - '.$section->header.'</li>':'' ?>
            <?= $section->header_class?'<li> Header - '.$section->header_class.'</li>':'' ?>
            <?= $section->description?'<li> Description - '.$section->description.'</li>':'' ?>
            <?= $section->raw_text?'<li> Raw Text - '.\common\models\Article::excerpt($section->raw_text,100).'</li>':'' ?>
            <?= $section->section_image?'<li> Section Image - '
                .Html::img('/img/'. $section->section_image, ['class'=>'gridThumb'])
                .'<sup>'.$section->section_image.'</sup>'
                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                    '/article-section/delete-image?id='.$section->id.'&propertyName=section_image',
                    [
                        'title' => Yii::t('yii', 'Удалить section_image'),
                        'data-confirm' =>'Точно удалить?',
                        'data-method'=>'post'
                    ])
                .'</li>':'' ?>
            <?= $section->section_image_alt?'<li> Image Alt - '.$section->section_image_alt.'</li>':'' ?>
            <?= $section->background_image?'<li> Background Image - '
                .Html::img('/img/'. $section->background_image, ['class'=>'gridThumb'])
                .'<sup>'.$section->background_image.'</sup>'
                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                    '/article-section/delete-image?id='.$section->id.'&propertyName=background_image',
                    [
                        'title' => Yii::t('yii', 'Удалить background_image'),
                        'data-confirm' =>'Точно удалить?',
                        'data-method'=>'post'
                    ])
                .'</li>':'' ?>
            <?= $section->thumbnail_image?'<li> Thumbnail Image - '
                .Html::img('/img/'. $section->thumbnail_image, ['class'=>'gridThumb'])
                .'<sup>'.$section->thumbnail_image.'</sup>'
                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                    '/article-section/delete-image?id='.$section->id.'&propertyName=thumbnail_image',
                    [
                        'title' => Yii::t('yii', 'Удалить thumbnail_image'),
                        'data-confirm' =>'Точно удалить?',
                        'data-method'=>'post'
                    ])
                .'</li>':'' ?>
            <?= $section->call2action_name?'<li> Call2Action Name - '.$section->call2action_name.'</li>':'' ?>
            <?= $section->call2action_link?'<li> Call2Action Link - '.$section->call2action_link.'</li>':'' ?>
            <?= $section->call2action_class?'<li> Call2Action Class - '.$section->call2action_class.'</li>':'' ?>
            <?= $section->call2action_description?'<li> Call2Action Description - '.$section->call2action_description.'</li>':'' ?>
            <?= $section->call2action_comment?'<li> Call2Action Comment - '.$section->call2action_comment.'</li>':'' ?>
            <?= $section->view?'<li> View - '.$section->view.'</li>':'' ?>
            <?= $section->color_key?'<li> Color Key - '.$section->color_key.'</li>':'' ?>
            <?= $section->structure?'<li> Structure - '.$section->structure.'</li>':'' ?>
            <?= $section->custom_class?'<li> Custom Class - '.$section->custom_class.'</li>':'' ?>

            <?php if ($section->blocks) : ?>
                <li>Блоки
                    <?php $blockNum=1; foreach ($section->blocks as $block) : ?>
                        <ul>
                            <div class="row mt20">
                                <div class="col-sm-4">
                                    Блок <?= $blockNum ?>. <?= $block->sort?'<sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$block->sort:'' ?> <span class="text-danger"><?= $block->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block/update?id='.$block->id,
                                        [
                                            'title' => Yii::t('yii', 'Редактировать блок'),
                                            'data-method'=>'post'
                                        ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-open-file"></span>', '/article-section-block-item/create?block_id='.$block->id,
                                        [
                                            'title' => Yii::t('yii', 'Добавить block item'),
                                            'data-method'=>'post'
                                        ]); ?>
                                    <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section-block/delete?id='.$block->id,
                                        [
                                            'title' => Yii::t('yii', 'Удалить блок'),
                                            'data-confirm' =>'Точно удалить со всеми block items?',
                                            'data-method'=>'post'
                                        ]); ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php $form = ActiveForm::begin([
                                        'method' => 'post',
                                        'action' => ['/article-section-block/upload'],
                                        'options' => ['enctype' => 'multipart/form-data'],
                                    ]); ?>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                                                'image'=>'Image',
                                                'background_image'=>'Background Image',
                                                'thumbnail_image'=>'Thumbnail Image',

                                            ])->label(false) ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= $form->field($uploadmodel, 'imageFile')
                                                ->fileInput(['class'=>'fileField'])->label(false) ?>
                                            <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$block->id])->label(false) ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-xs']) ?>
                                        </div>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                </div>
                            </div>


                            <?= $block->header?'<li> Header - '.$block->header.'</li>':'' ?>
                            <?= $block->header_class?'<li> Header - '.$block->header_class.'</li>':'' ?>
                            <?= $block->description?'<li> Description - '.$block->description.'</li>':'' ?>
                            <?= $block->raw_text?'<li> Raw Text '.
                                Html::a( '<span class="glyphicon glyphicon-fullscreen"></span>',
                                    '/article-section-block/raw-text-to-items?id='.$block->id,
                                    [
                                        'title' => Yii::t('yii', 'raw text to items (each line to item)'),
                                        'data-confirm' =>'Точно конвертировать текст в items?',
                                        'data-method'=>'post'
                                    ]).' '.
                                Html::a( '<span class="glyphicon glyphicon-th-list"></span>',
                                    ['/article-section-block/raw-text-to-items',
                                        'id'=>$block->id,
                                        'mode'=>2,
                                    ],
                                    [
                                        'title' => Yii::t('yii', 'raw text to items mode 2 (1-st line - head, next lines - text, delimeter - empty string)'),
                                        'data-confirm' =>'Точно конвертировать текст в items режим 2? (1 строка заголовок, 1 строка тело, разделитель пустая строка.) ?',
                                        'data-method'=>'post'
                                    ]).
                                ' - '.\common\models\Article::excerpt($block->raw_text,100).'</li>':'' ?>
                            <?php
                            $blockImageLi='';
                            if ($block->image) {
                                if (substr(trim($block->image),0,4)=='<svg') {
                                    $blockImageLi = '<li class="viewImageSvg"> Image <sup>svg</sup> - '.$block->image.'</li>';
                                } else {
                                    $blockImageLi = '<li> Image - '
                                        .Html::img('/img/'. $block->image, ['class'=>'gridThumb'])
                                        .'<sup>'.$block->image.'</sup>'
                                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                            '/article-section-block/delete-image?id='.$block->id.'&propertyName=image',
                                            [
                                                'title' => Yii::t('yii', 'Удалить image'),
                                                'data-confirm' =>'Точно удалить?',
                                                'data-method'=>'post'
                                            ])
                                        .'</li>';
                                }
                            }
                            ?>
                            <?= $block->image?$blockImageLi:'' ?>
                            <?= $block->image_alt?'<li> Image Alt - '.$block->image_alt.'</li>':'' ?>
                            <?= $block->background_image?'<li> Background Image - '
                                .Html::img('/img/'. $block->background_image, ['class'=>'gridThumb'])
                                .'<sup>'.$block->background_image.'</sup>'
                                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                    '/article-section-block/delete-image?id='.$block->id.'&propertyName=background_image',
                                    [
                                        'title' => Yii::t('yii', 'Удалить background_image'),
                                        'data-confirm' =>'Точно удалить?',
                                        'data-method'=>'post'
                                    ])
                                .'</li>':'' ?>
                            <?= $block->thumbnail_image?'<li> Thumbnail Image - '
                                .Html::img('/img/'. $block->thumbnail_image, ['class'=>'gridThumb'])
                                .'<sup>'.$block->thumbnail_image.'</sup>'
                                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                    '/article-section-block/delete-image?id='.$block->id.'&propertyName=thumbnail_image',
                                    [
                                        'title' => Yii::t('yii', 'Удалить thumbnail_image'),
                                        'data-confirm' =>'Точно удалить?',
                                        'data-method'=>'post'
                                    ])
                                .'</li>':'' ?>
                            <?= $block->call2action_name?'<li> Call2Action Name - '.$block->call2action_name.'</li>':'' ?>
                            <?= $block->call2action_link?'<li> Call2Action Link - '.$block->call2action_link.'</li>':'' ?>
                            <?= $block->call2action_class?'<li> Call2Action Class - '.$block->call2action_class.'</li>':'' ?>
                            <?= $block->call2action_description?'<li> Call2Action Description - '.$block->call2action_description.'</li>':'' ?>
                            <?= $block->call2action_comment?'<li> Call2Action Comment - '.$block->call2action_comment.'</li>':'' ?>
                            <?= $block->view?'<li> View - '.$block->view.'</li>':'' ?>
                            <?= $block->color_key?'<li> Color Key - '.$block->color_key.'</li>':'' ?>
                            <?= $block->structure?'<li> Structure - '.$block->structure.'</li>':'' ?>
                            <?= $block->custom_class?'<li> Custom Class - '.$block->custom_class.'</li>':'' ?>
                            <?= $block->accent?'<li> Accent - '.$block->accent.'</li>':'' ?>
                            <?php if ($block->items) : ?>
                            <li> Block Items
                                <?php $itemNum=1; foreach ($block->items as $item) : ?>
                                    <ul>
                                        <div class="row mt20">
                                            <div class="col-sm-4">
                                                Пункт <?= $itemNum ?> <?= $item->sort?'<sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$item->sort:'' ?> <span class="text-danger"><?= $item->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block-item/update?id='.$item->id,
                                                    [
                                                        'title' => Yii::t('yii', 'Редактировать item'),
                                                        'data-method'=>'post'
                                                    ]); ?>
                                                <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section-block-item/delete?id='.$item->id,
                                                    [
                                                        'title' => Yii::t('yii', 'Удалить item'),
                                                        'data-confirm' =>'Точно удалить?',
                                                        'data-method'=>'post'
                                                    ]); ?>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php $form = ActiveForm::begin([
                                                    'method' => 'post',
                                                    'action' => ['/article-section-block-item/upload'],
                                                    'options' => ['enctype' => 'multipart/form-data'],
                                                ]); ?>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <?= $form->field($uploadmodel, 'toModelProperty')->hiddenInput([
                                                            'value'=>'image',
                                                        ])->label(false) ?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <?= $form->field($uploadmodel, 'imageFile')->fileInput(['class'=>'fileField'])->label(false) ?>
                                                        <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$item->id])->label(false) ?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <?= Html::submitButton('Image Upload', ['class' => 'btn btn-success btn-xs']) ?>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end() ?>
                                            </div>
                                        </div>

                                        <?= $item->header?'<li> Header - '.$item->header.'</li>':'' ?>
                                        <?= $item->header_class?'<li> Header - '.$item->header_class.'</li>':'' ?>
                                        <?= $item->sort?'<li> Sort - '.$item->sort.'</li>':'' ?>
                                        <?= $item->description?'<li> Description - '.$item->description.'</li>':'' ?>
                                        <?= $item->text?'<li> Text - '.\common\models\Article::excerpt($item->text,100).'</li>':'' ?>
                                        <?= $item->comment?'<li> Comment - '.\common\models\Article::excerpt($item->comment,100).'</li>':'' ?>
                                        <?php
                                        if ($item->image) {
                                            if (substr(trim($item->image),0,4)=='<svg') {
                                                $itemImageLi = '<li class="viewImageSvg"> Image <sup>svg</sup> - '.$item->image.'</li>';
                                            } else {
                                                $itemImageLi = '<li> Image - '
                                                    . Html::img('/img/'. $item->image, ['class'=>'gridThumb'])
                                                    .'<sup>'.$item->image.'</sup>'
                                                    .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                                        '/article-section-block-item/delete-image?id='.$item->id.'&propertyName=image',
                                                        [
                                                            'title' => Yii::t('yii', 'Удалить image'),
                                                            'data-confirm' =>'Точно удалить?',
                                                            'data-method'=>'post'
                                                        ])
                                                    .'</li>';
                                            }
                                        }
                                        ?>
                                        <?= $item->image?$itemImageLi:'' ?>
                                        <?= $item->image_alt?'<li> Image Alt - '.$item->image_alt.'</li>':'' ?>
                                        <?= $item->link_name?'<li> Link Name - '.$item->link_name.'</li>':'' ?>
                                        <?= $item->link_url?'<li> Link Url - '.$item->link_url.'</li>':'' ?>
                                        <?= $item->link_class?'<li> Link Class - '.$item->link_class.'</li>':'' ?>
                                        <?= $item->link_description?'<li> Link Description - '.$item->link_description.'</li>':'' ?>
                                        <?= $item->link_comment?'<li> Link Comment - '.$item->link_comment.'</li>':'' ?>
                                        <?= $item->view?'<li> View - '.$item->view.'</li>':'' ?>
                                        <?= $item->color_key?'<li> Color Key - '.$item->color_key.'</li>':'' ?>
                                        <?= $item->structure?'<li> Structure - '.$item->structure.'</li>':'' ?>
                                        <?= $item->custom_class?'<li> Custom Class - '.$item->custom_class.'</li>':'' ?>
                                        <?= $item->accent?'<li> Accent - '.$item->accent.'</li>':'' ?>
                                        <?= $item->type?'<li> Type - '.$item->type.'</li>':'' ?>
                                    </ul>
                                <?php $itemNum++; endforeach; ?>
                            </li>
                            <?php endif; ?>
                            <?= $block->conclusion?'<li> Conclusion - '.\common\models\Article::excerpt($block->conclusion,100).'</li>':'' ?>
                            <?= $block->conclusion_class?'<li> Conclusion Class - '.$block->conclusion_class.'</li>':'' ?>
                        </ul>
                    <?php $blockNum++; endforeach; ?>
                </li>
            <?php endif; ?>

            <?= $section->conclusion?'<li> Conclusion - '.\common\models\Article::excerpt($section->conclusion,100).'</li>':'' ?>
            <?= $section->conclusion_class?'<li> Conclusion Class - '.$section->conclusion_class.'</li>':'' ?>
        </ul>

    <?php $sectionNum++; endforeach; ?>
<?php endif; ?>
    </section>

    <?= Html::a('Добавить секцию','/article-section/create?article_id='.$model->id, ['class' => 'mt50 btn btn-success']) ?>
</div>

    <section class="mt50">
        <ol class="breadcrumb">
            <li>Article Preview <?php if ($model->view) {echo ' | view => '.$model->view;} ?></li>
        </ol>
    </section>

<?php if ($model->view) : ?>
    <?= $this->render('/article/part_views/article/'.$model->view, [
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
            <?php if ($section->view) : ?>
                <?= $this->render('/article/part_views/section/'.$section->view, [
                    'model' => $section,
                    'article' => $model,
                ]) ?>
            <?php endif; ?>

            <?php if (!$section->view) : ?>
                <section class="<?= $section->color_key ?> <?= $section->custom_class ?>">
                    <?php if ($section->header) : ?>
                        <h2 class="<?= $section->header_class ?>"><?= $section->header ?></h2>
                    <?php endif; ?>
                    <?php if ($section->description) : ?>
                        <h3 class="text-center"><?= $section->description ?></h3>
                    <?php endif; ?>
                    <?php if ($section->blocks) : ?>
                        <?php foreach ($section->blocks as $block) : ?>
                            <?php if ($block->view) : ?>
                                <?= $this->render('/article/part_views/block/'.$block->view, [
                                    'model' => $block,
                                    'article' => $model,
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
            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
