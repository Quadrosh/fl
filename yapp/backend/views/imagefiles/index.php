<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagefiles-index">



<!--    <p>-->
<!--        --><?//= Html::a('Create Image file', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->


            <div class="row">
                <div class="col-xs-12">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="col-xs-6 col-xs-offset-6 col-sm-3 col-sm-offset-9 text-right">
                    <h4>Image Upload</h4>
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['/imagefiles/upload'],
                        'options' => ['enctype' => 'multipart/form-data'],
                    ]); ?>

                    <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>

                    <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end() ?>
                </div>

            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute'=> 'Image',
                            'value' => function($data)
                            {
                                $path = '<img class="adminTableImg" src="/img/'.$data['name'].'" alt="">';
                                return $path;
                            },
                            'format'=> 'html',
                        ],
                        'name',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>


            </div>



</div>

