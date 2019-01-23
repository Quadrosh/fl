<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$preorderForm = new \common\models\Preorders();

$breadcrumbs = new \common\models\Breadcrumbs();
$this->params['breadcrumbs'] = $breadcrumbs->construct($article->cat_ids);


$pages = $category->children()->all();


?>
<?= Alert::widget() ?>
    <h1 class="text-center"><?= $article->h1 ?></h1>

<div class="col-sm-offset-2 mt20">



    <?= common\widgets\MenuNestedSetsWidget::widget([
        'treeId'=>$category->tree,
        'formfactor'=>'categoryPage',
        'currentItem'=> $category->id,
        'tail'=> true,
    ]) ; ?>
</div>



