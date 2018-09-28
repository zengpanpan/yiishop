<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/8
 * Time: 16:49
 */
namespace app\controllers;
use yii\web\Controller;
use Yii;
use app\models\Category;
class MessageController extends Controller{
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
     * 错误信息
     * @return string
     */
    public function actionMessage(){
        return $this->render('message');

    }
}