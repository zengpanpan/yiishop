<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 16:05
 */
namespace app\controllers;
use yii\base\Exception;
use yii\web\Controller;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\models\Goods;
use Yii;
class CategoryController extends Controller{
    public $layout=false;
    public $request;
    public function init(){
        parent::init();
        $this->request=Yii::$app->request;
        $category=new Category();
        $cateList=$category->getCateList();
        $this->view->params['menu']=$cateList;//分类导航标记区分是否显示
    }

    /**
     * 商品二级分类详情
     * @return string
     */
    public function actionCategory(){
        return $this->render('category');
    }

    /**
     * 商品三级分类详情
     * @return string
     */
    public function actionCategoryList($cate_id){
        $goods=new Goods();
        $category=new Category();
        $cate_id=intval($cate_id);//强转为整数型
        $cateObj=Category::findOne($cate_id);
        $cateOne = ArrayHelper::toArray($cateObj);

        if(empty($cate_id) || $cateObj===null)//非法参数异常处理
        {
            $this->redirect(['index/index']);
        }

        $sonId=$category->getAllSonId($cate_id);//获取子id及自己id
        $bread=$category->getBreadNavigation($cateOne['pid'],$cateOne);//面包屑导航

        $goodsList=$goods->getGoodsList($sonId);//商品列表及总条数
        $date=[
            'goodsList'=>$goodsList['list'],
            'goodsCount'=>$goodsList['count'],
            'page'=>$goodsList['page'],
            'bread'=>$bread,

        ];
        return $this->render('categoryList',$date);
    }
}