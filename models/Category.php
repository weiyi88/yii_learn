<?php

namespace  app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord{

    public function getArticles(){

        $article=$this->hasMany(Wenzhang::className(),['cate_id'=>'id'])->asArray()->all();

        return $article ;
    }


}