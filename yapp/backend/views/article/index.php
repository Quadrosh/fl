<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h4>import Article from file</h4>
    <?php
    $uploadmodel = new \common\models\UploadForm();
    $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['/article/import'],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($uploadmodel, 'jsonFile')->fileInput()->label(false) ?>

    <?= Html::submitButton('import', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'list_name',
//            'cat_ids:ntext',
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
            'hrurl:url',
            'title',
            // 'description:ntext',
            // 'keywords:ntext',
            // 'exerpt:ntext',
            // 'exerpt_big:ntext',
            // 'h1',
            // 'topimage',
            // 'topimage_alt',
            // 'background_image:ntext',
            // 'thumbnail_image:ntext',
            // 'call2action_description',
            // 'call2action_name',
            // 'call2action_link',
            // 'call2action_class',
            // 'call2action_comment',
            // 'imagelink',
            // 'imagelink_alt',
            // 'author',
             'status',
            // 'view',
            // 'layout',
            // 'created_at',
            // 'updated_at',
            // 'site',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
