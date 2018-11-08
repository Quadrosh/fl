<?php


namespace common\widgets;
use common\models\Menu;
use yii\base\Widget;
use yii\helpers\ArrayHelper;


class MenuNestedSetsWidget extends Widget
{
    public $treeId;
    public $formfactor;
    public $data;
    public $tail = false;
    public $tree;
    public $menuFinal;
    public $currentItem;
    public $model;
    public $rootName = null;

    public function init()
    {
        parent::init();
        if ($this->formfactor === null) {
            $this->formfactor = 'ul';
        }
        $this->formfactor .= '.php';
    }
    public function run()
    {
        if ($this->tail == false) {
            $this->data = Menu::find()
                ->where(['tree'=>$this->treeId])
                ->indexBy('lft')
                ->orderBy('lft')
                ->asArray()
                ->all();
        } else {
            $category = \common\models\Menu::find()->where(['id'=>$this->currentItem])->one();

            $this->data = $category->branch()
                ->indexBy('lft')
                ->orderBy('lft')
                ->asArray()
                ->all();


//            $this->data = ArrayHelper::merge($catAsArray,$childs);
//                        echo '<pre>';print_r( $this->data,false);echo '</pre>'; die;
            $this->tree = $this->getNestedSetTree($this->data,$category['lft']);
//            echo '<pre>';print_r( $this->tree,false);echo '</pre>'; die;
            $this->menuFinal = $this->getMenuHtml($this->tree);
            return '<ul class=" list-unstyled">'.$this->menuFinal.'</ul>';

        }

        $this->tree = $this->getNestedSetTree($this->data);


        $this->menuFinal = $this->getMenuHtml($this->tree);

        return '<ul class=" list-unstyled">'.$this->menuFinal.'</ul>';

    }

    protected function getParentStyleTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$value) {
            if (empty($value['parent_id'])) {
                $tree[$id] = &$value;
            }
            else {
                $this->data[$value['parent_id']]['childs'][$value['id']] = &$value;
            }

        }
        return $tree;
    }

    protected function getNestedSetTree ($data, $left=0, $right = null)
    {
        $tree = [];
        foreach ($data as $key => $value) {
            if ($value['lft'] == $left + 1 && (is_null($right) || $value['rgt'] < $right)) {
                $tree[$key]= [];
                $tree[$key]['id']=$value['id'];
                $tree[$key]['url']=$value['url'];
                if ($this->rootName && $left==0) {
                    $tree[$key]['name']=$this->rootName;
                } else {
                    $tree[$key]['name']=$value['name'];
                }
                $tree[$key]['icon']=$value['icon'];
                $tree[$key]['depth']=$value['depth'];
                if($value['rgt']-$value['lft']>1){
                    $tree[$key]['childs'] = $this->getNestedSetTree($data, $value['lft'], $value['rgt']);
                }

                $left = $value['rgt'];
            }
        }
        return $tree;
    }





    protected function getMenuHtml($tree, $tab='',$menulevel='0')
    {
        $str = '';
        foreach ($tree as $item ) {
            $str .=$this->itemToTemplate($item, $tab, $menulevel);
        }
        return $str;
    }
    protected function itemToTemplate($item, $tab, $menulevel)
    {
        ob_start();
        include __DIR__ . '/menu_ns_forms/'. $this->formfactor;
        return ob_get_clean();
    }
}