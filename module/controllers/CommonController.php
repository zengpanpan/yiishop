<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/23
 * Time: 14:25
 */
namespace app\module\controllers;
use app\models\Brand;
use Yii;
use yii\web\Controller;
use app\models\Category;
class CommonController extends Controller{
    /**
     * 检测session登陆状态
     */
    public function init()
    {   $admin=Yii::$app->session->get('admin');
        if(!isset($admin))
        {
            $this->redirect(['/admin/login/login']);
        }
    }


    /**
     * 添加成功提示
     */
    public function success($msg){
        $info['msg']=$msg;
        $info['status']=1;
        $session=Yii::$app->session;
        $session->setFlash('info',$info);
    }
    /**
     *
     * 添加失败提示
     */
    public function error($msg){
        $info['msg']=$msg;
        $info['status']=0;
        $session=Yii::$app->session;
        $session->setFlash('info',$info);
    }

    /**
     * 分类下拉框
     * @return array
     */
    public function getCategory($cateId=0){
        $category=new Category();
        $cateList=$category->dropDownList($cateId);
        return $cateList;
    }

    /**
     * 品牌下拉框
     * @return array
     */
    public function getBrand(){
        $brand=new Brand();
        $brandList=$brand->getBrandList();
        return $brandList;
    }


}
