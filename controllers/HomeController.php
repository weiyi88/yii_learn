<?php
namespace app\controllers;

use \yii\base\Controller;

class HomeController extends  Controller{

    public function actionIndex(){
        $data=[
            'name'=>'aring',
            'age'=>23,
        ];
        p($data);


    }



}