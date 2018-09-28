<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 19:01
 */
namespace app\controllers;
use app\models\Category;
use app\models\Goods;
use app\models\Photo;
use app\models\Brand;
use yii\base\Exception;
use Yii;
use yii\web\Controller;
class ProductController extends Controller{
    public $layout=false;

    /**
     * 分类导航标继续
     */
    public function init(){
        parent::init();
        $category=new Category();
        $cateList=$category->getCateList();
        $this->view->params['menu']=$cateList;//分类导航标记区分是否显示
    }

    /**
     * 产品详情页
     * @return string
     */
    public function actionProduct($goods_id){
        $goods_id=intval($goods_id);//强转为整数值
        $goods=new Goods();
        $category=new Category();
        $brand=new Brand();
        $goodList=$goods->getGoodOne($goods_id);//商品获取
        $goodList->click_num=$goodList->click_num+1;//浏览量
        $goodList->save();

        if(empty($goods_id) || $goodList===null)//非法参数处理
        {
            $this->redirect(['index/index']);
        }

        $brand=$brand->getBrandOne($goodList['brand_id']);//品牌获取
        $cateOne=$category->getOneCate($goodList['cate_id']);//分类获取
        $bread=$category->getBreadNavigation($cateOne['pid'],$cateOne,$goodList['goods_name']);//面包屑导航
        $photo=new Photo();
        $PhotoList=$photo->getPhotoList($goods_id);//获取商品附图列表
        $img=json_decode($PhotoList['img']);//json转换
        $data=[
            'goodList'=>$goodList,
            'brand'=>$brand,
            'bread'=>$bread,
            'img'=>$img,
        ];
        return $this->render('product',$data);
    }
}

?>