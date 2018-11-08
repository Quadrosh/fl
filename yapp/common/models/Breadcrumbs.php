<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Filter form
 */
class Breadcrumbs extends Model
{
    public $breadcrumbs = [];

    public function construct($catIds){
//        $rawIds = $model['cat_ids'];
        $ids = json_decode($catIds);
        if ($ids) {
            foreach ($ids as $id) {
                $cat=\common\models\Menu::find()->where(['id'=>$id])->one();
                if (isset($cat)) {
                    if ( $cat->tree==0) {
                        $cat->tree=1;
                    }
                    $parent = $this->parent($cat);
                    if (isset($parent) && $parent->id != $cat->tree) {
                        $this->ifBGParent($parent,$cat);

                        $this->breadcrumbs[] = ['label' => $parent->name, 'url' => ['/' . $parent->url]];
                    }


                    $this->breadcrumbs[] = ['label' => $cat->name];
                    return $this->breadcrumbs;
                }
            }
        };
    }


    public function parent($category){
        return \common\models\Menu::find()
            ->andWhere('lft <='.$category->lft)
            ->andWhere('rgt >='.$category->rgt)
            ->andWhere(['depth'=>$category->depth-1])
            ->one();
    }


    public function ifBGParent($parent,$category){
        $grandPa = $this->parent($parent);
        if (isset($grandPa) && $grandPa->id != $category->tree) {
            $this->ifBGParent($grandPa,$category);
//            Yii::$app->params['breadcrumbs'][] = ['label' => $grandPa->name, 'url' => ['/' . $grandPa->url]];
            $this->breadcrumbs[] = ['label' => $grandPa->name, 'url' => ['/' . $grandPa->url]];
        } else {
            return false;
        }
    }



}
