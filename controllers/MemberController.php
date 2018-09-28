<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 18:52
 */
namespace app\controllers;
use dzer\express\Express;
use app\models\Users;
use app\models\Order;
use yii\base\Exception;
use Yii;
use yii\data\Pagination;
use yii\web\Response;
use yii\web\Controller;
class MemberController extends CommonController{
    public $layout='member';
    public $request;


    /**
     * request组件
     */
    public function init(){
        parent::init();
        $this->request=Yii::$app->request;
    }

    /**
     * 商品详情登陆处理
     */
    public function actionAjaxLogin(){
        $users=new Users();
        $request=Yii::$app->request;
        $user['name']=$request->get('name');
        $user['pwd']=md5($request->get('pwd'));
        $userOne=$users->getUserOne($user);//登陆会员信息结果
        $response=Yii::$app->response;
        $response->format=Response::FORMAT_JSON;//设置响应格式
        if(isset($userOne))//登陆成功
        {

            Yii::$app->session->set('user',$userOne);

            $response->data=['code'=>1,'msg'=>'欢迎登陆'];
        }
        else
        {
            $response->data=['code'=>0,'msg'=>'用户名或密码错误'];
        }
        Yii::$app->end();

    }

    /**
     * 个人中心首页
     * @return string
     */
    public function actionMember(){

        return $this->render('member');
    }

    /**
     * 收货地址
     * @return string
     */
    public function actionAddress(){
        return $this->render('address');
    }

    /**
     * 我的收藏
     * @return string
     */
    public function actionCollect(){
        return $this->render('collect');
    }

    /**
     * 我的订单
     * @return string
     */
    public function actionOrder(){
        $user=Yii::$app->session->get('user');
        $pageSize=Yii::$app->params['page']['pageSize'];//配置页码
        $query=Order::find()->where(['userid'=>$user['user_id']]);
        $page=new Pagination([
            'defaultPageSize'=>$pageSize,
            'totalCount'=> $query->count(),
        ]);
        $orderList= $query
            ->joinWith('orderGoods')
            ->orderBy('orderid DESC')
            ->offset($page->offset)
            ->limit($page->limit)
            ->asArray()
            ->all();

        $data=[
            'orderList'=>$orderList,
            'page'=>$page,
        ];
        return $this->render('order',$data);
    }

    /**
     * 订单物流跟踪
     */
    public function actionShip(){
        $shipno=Yii::$app->request->get('shipno');
        $data=Express::search($shipno);
       //var_dump(json_decode($data));exit();
        echo $data;die;
    }

    /**
     * 账户安全
     * @return string
     */
    public function actionSafe(){
        return $this->render('safe');
    }




}
?>