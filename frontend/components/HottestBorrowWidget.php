<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/5 0005
 * Time: 17:06
 */
namespace  frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class HottestBorrowWidget  extends Widget{

    public $hottestBorrow;

    public function init()
    {
        parent::init();
    }

    public function run(){

        $BorrowString='';

        foreach($this->hottestBorrow as $hotestBorrow){

            $BorrowString.='<div class="post">'.
                '<div class="title">'.
                '<p style="color:#777777;font-style:italic;">'.
                nl2br($hotestBorrow->bookname).'</p>'.
//                '<p class="text"> <span class="glyphicon glyphicon-user" aria-hidden="ture">
//							</span> '.Html::encode($hottestBorrow->user->username).'</p>'.

                '<p style="font-size:8pt;color:bule">
							《<a href="'.$hotestBorrow->book->url.'">'.Html::encode($hotestBorrow->book->bookname).'</a>》</p>'.
                '<hr></div></div>';

            ;
        }
        return $BorrowString;

    }



}