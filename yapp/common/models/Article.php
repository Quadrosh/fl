<?php

namespace common\models;

use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;


/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $list_name
 * @property string $cat_ids
 * @property string $hrurl
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $exerpt
 * @property string $exerpt_big
 * @property string $h1
 * @property string $topimage
 * @property string $topimage_alt
 * @property string $background_image
 * @property string $thumbnail_image
 * @property string $call2action_description
 * @property string $call2action_name
 * @property string $call2action_link
 * @property string $call2action_class
 * @property string $call2action_comment
 * @property string $imagelink
 * @property string $imagelink_alt
 * @property string $author
 * @property string $status
 * @property string $view
 * @property string $layout
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $site
 * @property string $raw_text
 */
class Article extends \yii\db\ActiveRecord
{
    public $categories;

    const STATUS_PAGE = 'page';
    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['list_name'], 'required'],
            [['cat_ids', 'description', 'keywords', 'exerpt', 'exerpt_big', 'raw_text', 'background_image', 'thumbnail_image'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['list_name', 'hrurl', 'title', 'h1', 'topimage', 'topimage_alt', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'imagelink', 'imagelink_alt', 'author', 'status', 'view', 'layout', 'site'], 'string', 'max' => 255],
            [['call2action_description'], 'string', 'max' => 510],
            [['categories'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site' => 'Site',
            'list_name' => 'List Name',
            'cat_ids' => 'Cat Ids',
            'hrurl' => 'Hrurl',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'exerpt' => 'Exerpt',
            'exerpt_big' => 'Exerpt Big',
            'h1' => 'H1',
            'topimage' => 'Topimage',
            'topimage_alt' => 'Topimage Alt',
            'background_image' => 'Background Image',
            'thumbnail_image' => 'Thumbnail Image',
            'call2action_description' => 'Call2action Description',
            'call2action_name' => 'Call2action Name',
            'call2action_link' => 'Call2action Link',
            'call2action_class' => 'Call2action Class',
            'call2action_comment' => 'Call2action Comment',
            'imagelink' => 'Imagelink',
            'imagelink_alt' => 'Imagelink Alt',
            'author' => 'Author',
            'status' => 'Status',
            'view' => 'View',
            'layout' => 'Layout',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',

        ];
    }

    static public function excerpt($text, $maxLength)
    {
        $cutDirtyText = substr($text, 0, $maxLength*3);
        $stripTaggedText = strip_tags($cutDirtyText);
        $cleanText = preg_replace("/&#?[a-z0-9]{2,8};/i"," ",$stripTaggedText);
        if (strlen($cleanText) < $maxLength) {
            return $cleanText;
        }
        $endPosition = strpos($cleanText, ' ', $maxLength);
        if ($endPosition !== false) {
            return substr($cleanText, 0, $endPosition);
        } else {
            return $cleanText;
        }
    }

    static public function cyrillicToLatin($text, $maxLength, $toLowCase=true)
    {
        $dictionary = array(
            'й' => 'i',
            'ц' => 'c',
            'у' => 'u',
            'к' => 'k',
            'е' => 'e',
            'н' => 'n',
            'г' => 'g',
            'ш' => 'sh',
            'щ' => 'shch',
            'з' => 'z',
            'х' => 'h',
            'ъ' => '',
            'ф' => 'f',
            'ы' => 'y',
            'в' => 'v',
            'а' => 'a',
            'п' => 'p',
            'р' => 'r',
            'о' => 'o',
            'л' => 'l',
            'д' => 'd',
            'ж' => 'zh',
            'э' => 'e',
            'ё' => 'e',
            'я' => 'ya',
            'ч' => 'ch',
            'с' => 's',
            'м' => 'm',
            'и' => 'i',
            'т' => 't',
            'ь' => '',
            'б' => 'b',
            'ю' => 'yu',

            'Й' => 'I',
            'Ц' => 'C',
            'У' => 'U',
            'К' => 'K',
            'Е' => 'E',
            'Н' => 'N',
            'Г' => 'G',
            'Ш' => 'SH',
            'Щ' => 'SHCH',
            'З' => 'Z',
            'Х' => 'X',
            'Ъ' => '',
            'Ф' => 'F',
            'Ы' => 'Y',
            'В' => 'V',
            'А' => 'A',
            'П' => 'P',
            'Р' => 'R',
            'О' => 'O',
            'Л' => 'L',
            'Д' => 'D',
            'Ж' => 'ZH',
            'Э' => 'E',
            'Ё' => 'E',
            'Я' => 'YA',
            'Ч' => 'CH',
            'С' => 'S',
            'М' => 'M',
            'И' => 'I',
            'Т' => 'T',
            'Ь' => '',
            'Б' => 'B',
            'Ю' => 'YU',

            '\-' => '-',
            '\s' => '-',
            '[^a-zA-Z0-9\-]' => '',
            '[-]{2,}' => '-',
        );
        foreach ($dictionary as $from => $to) {
            $text = mb_ereg_replace($from, $to, $text);
        }
        $text = mb_substr($text, 0, $maxLength, Yii::$app->charset);
        if ($toLowCase) {
            $text = mb_strtolower($text, Yii::$app->charset);
        }
        return trim($text, '-');
    }

    public function getSections()
    {
        return $this->hasMany(ArticleSection::class,['article_id'=>'id'])->orderBy(['sort' => SORT_ASC]);
    }

    public function beforeDelete()
    {
        $children = $this->sections;
        if (count($children)>0) {
            foreach ($children as $child) {
                $child->delete();
            }
            Yii::$app->session->setFlash('success', 'удалено '.count($children).' секций вместе со статьей');
        } else {
            Yii::$app->session->setFlash('success', 'нет дочерних объектов');
        }
        return true;
    }

    public function export()
    {
        $arr = $this->toArray();
        $arr['type']=self::class;
//        $arr['id'] = null;
        $sections = $this->sections;
        foreach ($sections as $section) {
            $arr['sections'][$section->id] = $section->toArray();
            $arr['sections'][$section->id]['type'] = ArticleSection::class;
            if ($section->blocks) {
                $blocks = $section->blocks;
                foreach ($blocks as $block) {
                    $arr['sections'][$section->id]['blocks'][$block->id] = $block->toArray();

                    if ($block->items) {
                        foreach ($block->items as $item) {
                            $arr['sections'][$section->id]['blocks'][$block->id]['items'][$item->id] = $item->toArray();
                        }
                    }
                }
            }
        }



        $json = Json::encode($arr);
        $jsonfile= Yii::getAlias('@webroot/tmp/export_article-'.$this->hrurl.'.json');
        $fp = fopen($jsonfile, 'w+');
        fwrite($fp, $json);
        fclose($fp);
        if (file_exists($jsonfile)) {
            Yii::$app->response->xSendFile($jsonfile)->send();
//            unlink($jsonfile);
        }
        return true;
    }



    public function import($json=null)
    {
        if (!$json) {

            $uploadmodel = new UploadForm();
            $importFile = UploadedFile::getInstance($uploadmodel, 'jsonFile');

            $root= Yii::getAlias('@webroot/');
            $tempPath = $root.'tmp/temp_import_article.json';
            if ($importFile->saveAs($tempPath)) {
                //            $jsonfile= Yii::getAlias('@webroot/export_article.json');
                $string = file_get_contents($tempPath,true);

                $obj = json_decode($string);

                $arr = json_decode(json_encode($obj),true);


                $arr['id'] = null;
                $arr['cat_ids'] = null;
                $arr['topimage'] = null;
                $arr['background_image'] = null;
                $arr['thumbnail_image'] = null;

                $oModel = new Article();
                $oModel->attributes = $arr;


                if($oModel->save()) {
                    $sections = isset($arr['sections'])? $arr['sections']:null;
                    if ($sections) {
                        foreach ($sections as $section) {
                            $newSection = new ArticleSection();
                            $section['article_id'] = $oModel->id;
                            $section['section_image'] = null;
                            $section['background_image'] = null;
                            $section['thumbnail_image'] = null;

                            $newSection->attributes = $section;
                            $newSection->save();

                            $blocks = isset($section['blocks'])? $section['blocks']:null;
                            if ($blocks) {
                                foreach ($blocks as $block) {
                                    $newBlock = new ArticleSectionBlock();
                                    $block['article_section_id'] = $newSection->id;
                                    $block['image'] = null;
                                    $block['background_image'] = null;
                                    $block['thumbnail_image'] = null;
                                    $newBlock->attributes = $block;
                                    $newBlock->save();

                                    $items = isset($block['items'])? $block['items']:null;
                                    if ($items) {
                                        foreach ($items as $item) {
                                            $newItem = new ArticleSectionBlockItem();
                                            $item['article_section_block_id'] = $newBlock->id;
                                            $item['image'] = null;
                                            $newItem->attributes = $item;
                                            $newItem->save();

                                        }
                                    }

                                }
                            }

                        }
                    }

                    Yii::$app->session->setFlash('success', 'Article import complete');

                    unlink($tempPath);
                    return true;
                } else {
                    Yii::$app->session->setFlash('error', 'Article import failed');
//                    return $this->errors;
                    return false;
                };

            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения временного файла');
                return false;
            }


            var_dump($oModel); die;

        }


    }
}
