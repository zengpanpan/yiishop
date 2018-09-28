<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order_goods}}".
 *
 * @property string $ogid
 * @property string $orderid
 * @property string $goods_id
 * @property string $goods_img
 * @property string $shop_price
 * @property string $goods_price
 * @property integer $buy_num
 * @property string $goods_sn
 * @property string $goods_name
 */
class OrderGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid', 'goods_id', 'goods_img'], 'required'],
            [['orderid', 'goods_id', 'buy_num'], 'integer'],
            [['shop_price', 'goods_price'], 'number'],
            [['goods_img', 'goods_name'], 'string', 'max' => 255],
            [['goods_sn'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ogid' => 'Ogid',
            'orderid' => '订单ID',
            'goods_id' => '商品ID',
            'goods_img' => '商品图片',
            'shop_price' => '商品原价',
            'goods_price' => '实付金额',
            'buy_num' => '商品数量',
            'goods_sn' => '商品编号',
            'goods_name' => '商品名称',
        ];
    }
    public function AddGoods($goods){

        if($this->load(['OrderGoods'=>$goods])&&$this->validate())
        {
            return $this->insert();
        }
        return false;
    }

}
