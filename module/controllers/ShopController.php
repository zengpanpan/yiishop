<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/22
 * Time: 9:25
 */
namespace app\module\controllers;
use app\models\Category;
use yii\base\Exception;//没用到
use \Yii;
use yii\web\Controller;
class ShopController extends CommonController{//分类控制器
    public $layout='navcommon';

    /**
     * @商品分类添加
     */
    public function actionInsert(){
        $category=new Category();
        $request=Yii::$app->request;
        if($request->isPost)//添加操作
        {
            $post=$request->post();

            if($category->load($post)&& $category->save())
            {
                $category['cate_name']='';
                $this->success('添加成功');
            }
            else
            {
                $this->error('添加失败');
            }
        }

            //添加默认表单
            $cateList=$category->dropDownList();//上级类转换['1'=>'男','2'=>'女']格式
            return $this->render('insert',['cateList'=>$cateList,'category'=>$category]);

    }
    /**
     * 商品分类列表
     */
    public function actionShow(){
        $category=new Category();
        $cateList=$category->getShow();//调用model分类信息
        return $this->render('show',['cateList'=>$cateList]);
    }

    /**
     * 分类删除
     * @param $cate_id
     * @throws \Exception
     */
    public function actionDel($cate_id){

        $res=Category::find()->where(['pid'=>$cate_id])->count()>0;

           if($res)
           {
               $this->error('有子类不能删');
           }
           else
           {
               if(Category::findOne($cate_id)->delete())
               {
                   $this->success('删除成功');
               }
               else
               {
                   $this->error('删除失败');
               }

           }

        $this->redirect(['shop/show']);
    }

    /**
     * 分类修改
     * @param $cate_id
     * @return string
     */
    public function actionUpdate($cate_id){
        $category=new Category();
        $request=Yii::$app->request;
        $cate=$category::findOne($cate_id);
        if($request->isPost)//修改
        {
            $post=$request->post();
            if($cate->load($post)&&$cate->save())
            {
                $this->success('修改成功');
            }
            else
            {
                $this->error('修改失败');
            }
        }
            //修改默认表单
            $list=$category->dropDownList($cate_id);
            return $this->render('update',['cate'=>$cate,'list'=>$list]);

    }

}
?>