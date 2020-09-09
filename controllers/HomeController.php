<?php
namespace app\controllers;



use app\models\Category;
use app\models\Wenzhang;
use \yii\base\Controller;



class HomeController extends  Controller{

    public $layout='home';

    public function actionIndex(){
        /*
         * get
         * post
         * 请求
         * 判断get，post请求
         * 访问用户ip
         * */

       $request=\Yii::$app->request;

       //$id=$request->get('id',1);

       //$username=$request->post('username','pengqiwen');

       //var_dump($username);

        //$data= $request->isGet;

        //$data=$request->isPost;

        $data=$request->userIP;


        var_dump($data);

       //var_dump($id);

        //echo $id ;

    }


    public function actionTest(){
        /*
         *compact 方法分配多个参数
         * */
        $request=\Yii::$app->request;

        //echo "hello";

        //$data=$request->userIP;

        //$username='Aring';

        $data=[
            'name'=>'Aring',
            'age'=>23,
            'fuck'=>'pengqiw',

            'arr'=>[
                'number'=>7,
                'age'=>34,
            ],
        ];

        $fun=[
            'wahaha'=>'娃哈哈',
            'nf'=>'农夫山泉',
            'pussy'=>'pp',
        ];



        //return $this->renderPartial('Test',['data'=>$data,]);

        return $this->renderPartial('test',compact('data','fun') );

    }


    public function actionFun(){

        $request=\Yii::$app->request;

        $data=[
            'name'=>'fuck bitch <script>alert(1) <script>'
        ];

        return $this->renderPartial('fun',$data);

    }

    public function actionModel(){

        return $this->render('model');
    }

    public function actionArticle(){

       /* $sql='select * from article where id= 2';

      $data=Article::findBySql($sql)->all();

      p($data);*/

       $request=\Yii::$app->request;

       $id=$request->get('id');


       /*sql 注入*/
       //$sql='select content from article where id='.$id;

        //$sql='select * from article where id ='.$id.' or 1=1';
        //搜索表内所有内容

        //$sql='select * from article where id ='.$id.';drop table article';

        //删除表


        /*使用占位符防止注入*/

        $sql="select * from artilce where id=:id";

        $data=Article::findBySql($sql,['id'=>$id])->all();



       p($data);

       // return $this->render('Article',$data);

    }

    public function actionShuju(){

       /* $request=\Yii::$app->request;

        $id=$request->get('id');

        $sql="select * from wenzhang where id =:id";

        $data=Wenzhang::findBySql($sql,[':id'=>$id])->all();
        p($data);*/

       //查询所有数据
        /*$data=Wenzhang::find()->all();
        p($data);*/

        //加条件筛选数据
        //$data=Wenzhang::find()->where(['id'=>1])->all();
        //$data=Wenzhang::find()->where(['>','id',1])->all();
        //$data=Wenzhang::find()->where(['between','id',2,3])->all();
        //$data=Wenzhang::find()->where(['like','title','媳妇'])->all();

        //查询一条数据
        //$data=Wenzhang::find()->where(['>','id',1])->one();
        //$data=Wenzhang::findOne(1);

        //查询多条数据
        /*$data=Wenzhang::findAll([1,3]);
        echo '<pre>';
       var_dump($data);*/

        /*节省空间方案
        1，对象转换为数组
        2，分段提取，例如：数据库1k条，每次提取100条到内存，提取10次
        */
        /*$data=Wenzhang::find()->asArray()->all();
        p($data);*/

        foreach (Wenzhang::find()->batch(1)as $article){
            echo count($article),'-';
            $data[]=$article;
        }

        p($data);


    }

    public function actionTianjia(){

         $article= new Wenzhang();

        $article->title='村口那只大黄狗';
        $article->content='汪汪汪汪汪汪汪汪';

        //插入数据
        //$data=$article->save();
        $data=$article->insert();

        //返回id
        $id=$article->attributes['id'];


        p($id);
    }

    public function actionXiugai(){

        //修改记录
        /*$article =Wenzhang::findOne(8);
        $article->title='彭绮文最漂亮';
        //$data=$article->update();
        $data=$article->save();*/

        //修改查看次数(单个字段）
        //字段自增
        //updataAllCounters(自增字段，条件，参数)
        $data=Wenzhang::updateAllCounters(['num'=>1],['id'=>3]);


        p($data);
    }

    public function actionShanchu(){

        //$delete = Wenzhang::findOne(7);

        //one 查出来是数组，all查出来是对象
        //$delete=Wenzhang::find()->where(['id'=>8])->one();
        //$data=$delete->delete();


        /*$delete=Wenzhang::find()->where(['id'=>9])->all();
        $data=$delete[0]->delete();*/

        //deleteAll(条件，参数）
        $data=Wenzhang::deleteAll('id=:id',[':id'=>4]);

        p($data);
    }



    /*
     * 在控制器大量操作模型，会产生大量耦合
     * 应该写到模型里面去
     * */
    public function  actionYiduiduo(){


        $data=Category::findOne(3);



        //以Category表的字段，联系Wenzhang表，关联查询
        //$articles=Wenzhang::find()->where(['cate_id'=>$data->attributes['id']])->all();

        //$articles=$data->hasMany('app\models\Wenzhang',['cate_id'=>'id'])->all();
        $articles=$data->hasMany(Wenzhang::className(),['cate_id'=>'id'])->all();

        p($articles);



    }


    public  function  actionMod(){



        $article=Category::findOne(2);

        $data=$article->getArticles();

        p($data);
    }


}