<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/5
 * Time: 19:58
 */
namespace app\Controllers;
use Yii;
use yii\web\Controller;
class CommonController extends Controller{
    public function init(){
        parent::init();
        $user=Yii::$app->session->get('user');
        //Ajax请求跳过
        if(!Yii::$app->request->isAjax)
        {
            if(!isset($user))//登陆检测
            {
                $this->redirect(['/login/login']);
            }
        }
    }
}
?>