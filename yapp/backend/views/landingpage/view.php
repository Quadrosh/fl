<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LandingPage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Landing Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landing-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Прям хочешь совсем удалить?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Copy', ['copy', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Создаем новый и копируем все это туда?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Alt2Svg', ['/landingpage/alt-to-svg', 'id' => $model->id], [
            'class' => 'btn btn-primary',
//            'data' => [
//                'confirm' => 'Создаем новый и копируем все это туда?',
//                'method' => 'post',
//            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site',
            'name',
            [
                'attribute'=>'hrurl',
                'value' => function($data)
                {
                    if (Yii::$app->request->getHostName() == 'cp.finlider.local') {
                        $lpSite = $data['site'];
                        $site = str_replace('.ru','.local',$lpSite);
                        $site = str_replace('.su','.local',$site);
                        return '<a  href="http://'.$site.'/lp/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    } else {
                        return '<a  href="http://'.$data['site'].'/lp/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    }
                },
                'format'=> 'html',
            ],

            'seo_logo:ntext',
            'title',
            'description:ntext',
            'keywords:ntext',
            'view',
            'layout',
            'color',
        ],
    ]) ?>
<h2>Секции</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
<!--                <th>Page ID</th>-->
                <th>ID</th>
                <th>Order Num</th>
                <th>Section Type</th>
                <th>Head</th>
                <th>Lead</th>
                <th>Stylekey</th>

                <th </th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($sections as $section) : ?>
            <tr >
<!--                <td>--><?//= $section['page_id'] ?><!--</td>-->
                <td><?= $section['id'] ?></td>
                <td><?= $section['order_num'] ?></td>
                <td><?= $section['section_type'] ?></td>
                <td><?= $section['head'] ?></td>
                <td><?= $section['lead'] ?></td>
                <td><?= $section['stylekey'] ?></td>

                <td>
                    <a href="/landingsection/view?id=<?= $section['id'] ?>"
                       title="View"
                       aria-label="View"
                       data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="/landingsection/update?id=<?= $section['id'] ?>"
                       title="Update"
                       aria-label="Update"
                       data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="/landinglistitem/create?section_id=<?= $section['id'] ?>"
                       title="Create List Item"
                       aria-label="Create Item"
                       data-pjax="0"
                       data-method="post"><span class="glyphicon glyphicon-open-file"></span></a>
                </td>
                <td>
                    <a href="/landingsection/delete?id=<?= $section['id'] ?>"
                       title="Delete Section"
                       aria-label="Create Item"
                       data-confirm="Точно удалить? Вместе с секцией удалятся все дочерние объекты. Загруженные картинки не удалятся"
                       data-pjax="0"
                       data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
    <?= Html::a('Создать секцию', ['/landingsection/create', 'page_id' => $model->id], ['class' => 'btn btn-success']) ?>
    <h2>List Items</h2>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <!--                <th>Page ID</th>-->
            <th>ID</th>
            <th>Section ID</th>
            <th>Order Num</th>
            <th>Head</th>
            <th>Discr</th>
            <th>Text</th>
            <th>Extra</th>
            <th>Image</th>
            <th>Image Alt</th>


            <th class="action-column">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listItems as $listItem) : ?>
            <tr >
                <td><?= $listItem['id'] ?></td>
                <td><?= $listItem['section_id'] ?></td>
                <td><?= $listItem['order_num'] ?></td>
                <td><?= $listItem['head'] ?></td>
                <td><?= $listItem['discr'] ?></td>
                <td><?= nl2br($listItem['text']) ?></td>
                <td><?= $listItem['extra'] ?></td>
                <td><?= $listItem['image'] ?></td>
                <td><?= $listItem['image_alt'] ?></td>

                <td>
                    <a href="/landinglistitem/view?id=<?= $listItem['id'] ?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="/landinglistitem/update?id=<?= $listItem['id'] ?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>



                </td>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
    <h4>Alt 2 SVG</h4>
    <p>Добавить в svg: <br>
        в head - aria-labelledby="svg_li_$id$_title"  <br>
        в тело первым элементом - (title id="svg_li_$id$_title">$alt$(/title>
        </p>
</div>
