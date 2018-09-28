<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 15:50
 */
namespace app\controllers;
use app\models\Category;
use app\models\Goods;
use yii\web\Controller;

class IndexController extends Controller{
    public $layout=false;

    /**
     * 首页显示
     * @return string
     */
    public function actionIndex(){
        $category=new Category();
		$category1=new Category();
        $goods=new Goods();
        $cateList=$category->getCateList();
        $this->view->params['show']=true;//分类导航标记区分是否显示
        $this->view->params['menu']=$cateList;//分类导航标记区分是否显示
        $hot=$goods->getHotList();//最热商品

        $date=[
            'hot'=>$hot,
        ];

        return $this->render('index',$date);
    }
}