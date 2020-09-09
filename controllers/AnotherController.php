<?php

namespace app\controllers;

use yii\web\Controller;

class AnotherController extends Controller{


    public  function  actionSession(){


        //实例化seeion
        $session=\Yii::$app->session;

        //开启session,不是必须的，启用可自动开启
        $session->open();
        $session->set('name','Aring');

        $session['age']=23;


        //获取session

        $name=$session->get('name');
        $age=$session['age'];


        //session关闭
        //一般不用手动关闭
        $session->close();

        p($name);

    }

}
