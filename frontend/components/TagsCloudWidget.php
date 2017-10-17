<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29 0029
 * Time: 19:36
 */
namespace frontend\components;

use yii\Base\Widget;
use yii\helpers\Html;
//use Yii;

class TagsCloudWidget extends Widget
{
    public $tags;

    public function init()
    {
        parent::init();
    }

    public  function  run()
    {
        $tagString ='';
        $frontStyle =array(
            '6'=>'danger',
            '5'=>'info',
            '4'=>'warning',
            '3'=>'primary',
            '2'=>'success',
            );

        foreach ($this->tags as $tag=>$weight)
        {
            // <a href=...??r=book/index$BookSearch[booktags]>

 //           <span class="label label-danger">'.$tag.'</span></h'.$weight.'></a>';

//            $url = \Yii::$app->urlManager->createUrl(['book/index','BookSearch[booktag]'=>$tag]);
//            $tagString.='<a href="'.$url.'">'.

            $tagString.='<a href="'.\Yii::$app->homeUrl.'?r=book/index&BookSearch[booktag]='.$tag.'">'.
                '  <h'.$weight.' style="display:inline-block;"><span class="label label-'
                .$frontStyle[$weight].'">'.$tag.'</span></h'.$weight.'></a>';
        }

        return $tagString;



    }


}