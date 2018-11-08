<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $icon
 * @property string $url
 * @property string $description
 */

use creocoder\nestedsets\NestedSetsBehavior;

class Menu extends \yii\db\ActiveRecord
{
    public $sub;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::class,
                 'treeAttribute' => 'tree',
            ],
        ];
    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//
//            $parent = self::find()->andWhere(['id'=>$this->sub])->one();
//            $this->prependTo($parent);
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['tree', 'lft', 'rgt', 'depth', 'sub'], 'integer'],
            [['name',], 'string', 'max' => 255],
            [['icon'], 'string'],
            [['url'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000],
            [['tree', 'lft', 'rgt', 'depth'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'icon' => 'icon',
            'name' => 'Name',
            'url' => 'Url',
            'description' => 'Description',
        ];
    }

    /**
     * Gets the children of the node.
     * @param integer|null $depth the depth
     * @return \yii\db\ActiveQuery
     */
    public function branch($depth = null)
    {
        $condition = [
            'and',
            ['>', 'lft', $this->lft],
            ['<', 'rgt', $this->rgt],
        ];

        if ($depth !== null) {
            $condition[] = ['<=', 'depth', $this->depth + $depth];
        }

        $this->applyTreeAttributeCondition($condition);
        $this->applySelf($condition);

        return $this->find()->andWhere($condition)->addOrderBy(['lft' => SORT_ASC]);
    }

    /**
     * @param array $condition
     */
    protected function applyTreeAttributeCondition(&$condition)
    {
        if ($this->treeAttribute !== false) {
            $condition = [
                'and',
                $condition,
                ['tree' => $this->tree]
            ];
        }

    }
    /**
     * @param array $condition
     */
    protected function applySelf(&$condition)
    {
        if ($this->treeAttribute !== false) {
            $condition = [
                'or',
                $condition,
                ['id' => $this->id]
            ];
        }

    }
}
//                 [$this->treeAttribute => $this->owner->getAttribute($this->treeAttribute)]
