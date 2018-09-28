<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 16:15
 */
namespace app\controllers;
use Yii;
use app\models\Cart;
use app\models\Category;
use app\models\Goods;
use yii\web\Response;

class CartController extends CommonController{
    public $layout=false;
    public $request;
    public  $cart;
    public function init(){
        parent::init();
        $this->request=Yii::$app->request;
        $category=new Category();
        $this->cart=new Cart();
        $cateList=$category->getCateList();
        $this->view->params['menu']=$cateList;//分类导航标记区分是否显示
    }

    /**
     * 查看购物车
     * @return string
     */
    public function actionCart(){
        $user=Yii::$app->session->get('user');//session值
        $cartList=$this->cart->getCartInfo();
        //var_dump($cartList);
        return $this->render('cart',['cartList'=>$cartList['goodsList'],'prices'=>$cartList['total']['prices']]);
    }

    /**
     * 加入购物车
     */
    public function actionAdd(){
        $request=Yii::$app->request;
        $response=Yii::$app->response;
        $cart['buy_num']=intval($request->get('num'))>0 ? intval($request->get('num')) : 1;
        $cart['goods_id']=intval($request->get('goods_id'));
        //检测session值
        $response->format=Response::FORMAT_JSON;//将响应格式设为JSON格式
        $userInfo=Yii::$app->session->get('user');
        if(!isset($userInfo))
        {
            $response->data=['code'=>0,'msg'=>'请先登陆'];//data为JSon格式指定
            Yii::$app->end();

        }

        //查询当前商品信息
        $goods=new Goods();
        $goodsInfo=$goods->getGoodInfo($cart['goods_id']);

        //判断是否下架
        if($goodsInfo['is_delete']==1 || $goodsInfo['is_on_sale']==0)
        {
            $response->data=['code'=>1,'msg'=>'该商品已下架'];
            Yii::$app->end();
        }

        //判断是否库存不足
        if($goodsInfo['goods_num']<$cart['buy_num'])
        {
            $response->data=['code'=>2,'msg'=>'该商品库存不足'];
            Yii::$app->end();
        }
        //判断是否促销 确定价格
        $time=time();
        $cart['goods_price']=($goodsInfo['promote_start_date']<=$time && $time<=$goodsInfo['promote_end_date']) ? $goodsInfo['promote_price'] : $goodsInfo['shop_price'];

        //添加入库
        $cart['user_id']=$userInfo['user_id'];//session中的id
        $where=['goods_id'=>$cart['goods_id'],'user_id'=>$cart['user_id']];
        $carts=new Cart();

        $res=$carts->findOne($where);

        //判断是否已加购物车
        if($res===null)
        {
            $addCart=$carts->AddCart($cart);
            if($addCart)
            {
                $cateInfo=$carts->getCartInfo();
                $response->data=['code'=>3,'msg'=>'添加成功','data'=>$cateInfo['total']];
            }
            else
            {
                $response->data=['code'=>4,'msg'=>'添加失败'];
            }


        }
        else
        {
            $res->buy_num+=$cart['buy_num'];
            if($res->save())
            {
                $cateInfo=$carts->getCartInfo();
                $response->data=['code'=>3,'msg'=>'添加成功','data'=>$cateInfo['total']];
            }
            else
            {
                $response->data=['code'=>4,'msg'=>'添加失败'];
            }

        }
        Yii::$app->end();

    }

    /**
     * 购物车删除
     * @param $cart_id
     */
    public function actionDel($cart_id){
        $cate_id=intval($cart_id);
        echo $cate_id;

    }

}