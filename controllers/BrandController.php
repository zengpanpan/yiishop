<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 16:15
 */
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Category;
class BrandController extends Controller{
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
     * 品牌详情
     * @return string
     */
    public function actionBrand(){
        return $this->render('brand');
    }

    /**
     * 品牌列表详情
     * @return string
     */
    public function actionBrandList(){
        return $this->render('brandList');
    }
}
