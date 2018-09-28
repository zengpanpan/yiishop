<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/10
 * Time: 9:56
 */
namespace app\module\controllers;
use app\module\models\OrderLog;
use yii\base\Exception;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Address;
use app\models\OrderGoods;
use app\models\Order;
use Yii;
class OrderController extends CommonController{
    public $layout='navcommon';

    /**
     * 订单列表
     * @return string
     */
    public function actionShipList()
    {
        $order=new Order();
        $query=$order->find();
        $page=new Pagination(//页码
            [
                'totalCount'=>$query->count(),
                'defaultPageSize'=>Yii::$app->params['page']['pageSize'],
            ]
        );
        $orderList=$query//订单查询
            ->offset($page->offset)
            ->limit($page->limit)
            ->orderBy('createtime Desc')
            ->all();
        $data=[
            'orderList'=>$orderList,
            'page'=>$page,
        ];
        return $this->render('list',$data);
    }

    /**
     * 订单信息
     * @return string
     */
    public function actionShipShow(){
        $orderid=intval(Yii::$app->request->get('orderid'));
        try
        {
            $orderList=order::find()->where(['orderid'=>$orderid])->asArray()->one();
            if(!isset($orderid)||empty($orderid)||$orderList==null)
            {
                throw new Exception();
            }
            //订单信息
            $address=Address::getAddress($orderList);//完整地址信息
            //订单商品
            $goodsList=OrderGoods::find()->where(['orderid'=>$orderid])->asArray()->all();
            //订单操作
            $actionList=OrderLog::find()->where(['orderno'=>$orderList['orderno']])->asArray()->all();
            $data=[
                'address'=>$address,
                'orderList'=>$orderList,
                'goodsList'=>$goodsList,
                'actionList'=>$actionList,
            ];
            return $this->render('show',$data);


        }
        catch(Exception $e)
        {
            $this->redirect(['order/ship-list']);
        }
    }

    /**
     * 订单操作
     */
    public function actionPay(){
        $orderid=intval(Yii::$app->request->get('orderid'));
        $act=Yii::$app->request->get('act');

        $order=Order::findOne($orderid);

        $orderLog=new OrderLog();//日志模型
        try
        {
            if(!isset($orderid)|| empty($orderid)|| empty($act)||$order==null)
            {

                throw new Exception();
            }
            if($act=='pay')//付款操作
            {
                $order->paystatus=Order::IS_PAY;//支付状态
                $order->status=Order::IS_STATUS;//订单状态
                $order->paytime=time();
                $order->paytype='admin';
                $result=$order->save();
                //写操作日志
                $orderLog->wirte('支付',OrderLog::getResult($result),$order['orderno']);
                if($result)
                {
                    $this->success('支付成功');
                }
                else
                {
                    $this->error('支付失败');
                }
                $this->redirect(['order/ship-show','orderid'=>$orderid]);
            }
            elseif($act=='ship')//发货操作
            {
                $order=Order::findOne($orderid);
                $request=Yii::$app->request;
                if($request->isPost)
                {
                    $post=$request->post();
                   if($order->load($post)&&$order->validate())
                   {
                       $order->shipstatus=Order::IS_SHIP;
                       $order->sendtime=time();
                       $result=$order->save();
                       //写操作日志
                       $orderLog->wirte('发货',OrderLog::getResult($result),$order['orderno']);
                       if($result)
                       {
                           $this->success('发货成功');
                       }
                       else
                       {

                           $this->error('发货失败');
                       }
                       $this->redirect(['order/ship-show','orderid'=>$orderid]);
                   }
                }
                return $this->render('add',['order'=>$order]);

            }
            elseif($act=='finish')
            {
                $order->status=Order::IS_SUCCESS_STATUS;//订单状态
                $result=$order->save();
                //写操作日志
                $orderLog->wirte('完成',OrderLog::getResult($result),$order['orderno']);
                if($result)
                {
                    $this->success('订单完成成功');
                }
                else
                {
                    $this->error('订单完成失败');
                }
                $this->redirect(['order/ship-show','orderid'=>$orderid]);
            }

        }
        catch(Exception $e)
        {
            $this->redirect(['order/ship-list']);
        }

    }


}