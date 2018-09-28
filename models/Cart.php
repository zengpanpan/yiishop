<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/3
 * Time: 21:16
 */
namespace app\models;

use yii\db\ActiveRecord;
use Yii;
class Cart extends ActiveRecord{
    public function rules(){
        return [
            [['add_time','buy_num','goods_price','goods_id','user_id'],'safe'],
        ];

    }

    /**
     * 购物车入库
     * @param $data
     * @return bool
     */
    public function AddCart($data)
    {

        if($this->load(['Cart'=>$data])&&$this->validate())
        {
            $this->add_time=time();
           return $this->save();

        }
        else
        {
            return false;
        }
    }

    /**
     * 计算购物车商品件数，种类和价格
     * @return array
     */
    public function getCartInfo(){
        $user=Yii::$app->session->get('user');
        $cartList=$this->find()->where(['user_id'=>$user['user_id']])->asArray()->all();
        $type=0;//种类
        $goods_num=0;//件数
        $prices=0;//总价
        if(count($cartList)>0)
        {
            foreach($cartList as $key=>$v)
            {
                $type+=1;
                $goods_num+=$v['buy_num'];
                $prices+=$v['buy_num']*$v['goods_price'];
                $cartList[$key]['total']=$v['buy_num']*$v['goods_price'];
                $cartOne=Goods::find()//购物车商品名和图片查询追加
                    ->select('goods_name,goods_sn,shop_price,goods_img')
                    ->where(['goods_id'=>$v['goods_id']])
                    ->asArray()
                    ->One();
                $cartList[$key]['goods_name']=$cartOne['goods_name'];
                $cartList[$key]['goods_img']=$cartOne['goods_img'];
                $cartList[$key]['goods_sn']=$cartOne['goods_sn'];
                $cartList[$key]['shop_price']=$cartOne['shop_price'];


            }
        }

        return ['goodsList'=>$cartList,'total'=>['type'=>$type,'goods_num'=>$goods_num,'prices'=>$prices]];
    }

    /**
     * 清除购物车
     * @return int
     */
    public function clearAllCart(){
        $user=Yii::$app->session->get('user');

        return self::deleteAll('user_id=:user_id',[':user_id'=>$user['user_id']]);
    }



}