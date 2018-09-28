<?php

namespace app\models;
use Yii;
class Order extends \yii\db\ActiveRecord
{
    const STATUS=1;//订单已生成
    const IS_STATUS=2;//订单已确认
    const IS_NOT_STATUS=3;//订单已取消
    const IS_ERROR_STATUS=4;//订单已作废
    const IS_SUCCESS_STATUS=5;//订单已完成
    const IS_PAY=1;//已支付
    const IS_NOT_PAY=0;//未支付
    const IS_SHIP=1;//订单已发送
    const IS_NOT_SHIP=0;//订单未发送
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * 订单状态
     * @var array
     */
    public static $orderStatus=[
        self::STATUS=>'已生成',
        self::IS_STATUS=>'已确认',
        self::IS_NOT_STATUS=>'已取消',
        self::IS_ERROR_STATUS=>'已作废',
        self::IS_SUCCESS_STATUS=>'已完成',
    ];
    /**
     * 订单状态样式
     * @var array
     */
    public static $orderStyle=[
        self::STATUS=>'label label-default',
        self::IS_STATUS=>'label label-default',
        self::IS_NOT_STATUS=>'label label-warning',
        self::IS_ERROR_STATUS=>'label label-warning',
        self::IS_SUCCESS_STATUS=>'label label-success',
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderno', 'userid', 'paytype', 'shipid', 'consignee'], 'required'],
            [['userid', 'shipid', 'status', 'paystatus', 'shipstatus', 'country', 'province', 'city', 'district', 'paytime', 'sendtime', 'createtime', 'isdelete'], 'integer'],
            [['payamount', 'realamount', 'shipfee',  'discount', 'orderamount'], 'number'],
            [['note'], 'string'],
            [['orderno', 'paytype', 'consignee', 'mobile','payment'], 'string', 'max' => 20],
            [['zipcode'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 250],
            [['shipno'], 'string', 'max' => 30],
            [['postscript', 'tradeno'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderid' => 'Orderid',
            'orderno' => '订单号',//
            'userid' => '用户ID',//
            'paytype' => '支付方式方式',//
            'shipid' => '用户选择的配送ID',//
            'status' => '订单状态 1生成订单,2订单已确认,3取消订单(客户触发),4作废订单(管理员触发),5完成订单,6退款,7部分退款',
            'paystatus' => '支付状态 0：未支付; 1：已支付;',
            'shipstatus' => '配送状态 0：未发送,1：已发送,2：部分发送',
            'consignee' => '收货人姓名',//
            'zipcode' => '邮编',//
            'country' => '国ID',//
            'province' => '省ID',//
            'city' => '市ID',//
            'district' => '区ID',//
            'address' => '收货地址',//
            'mobile' => '手机',//
            'payamount' => '应付商品总金额',//
            'realamount' => '实付商品总金额',//
            'shipfee' => '总运费金额',//
            'paytime' => '付款时间',
            'sendtime' => '发货时间',
            'createtime' => '下单时间',//
            'postscript' => '用户附言',//
            'note' => '管理员备注:',
            'isdelete' => '是否删除1为删除',
            'discount' => '订单折扣金额',
            'orderamount' => '订单总金额',//
            'tradeno' => '支付平台交易号',
            'payment' => '支付价',
            'shipno' =>'快递编号:',
        ];
    }

    /**
     * 生产订单号
     * @return string
     */
    public function createGoodsNo(){
        return date('YmdHis').rand(100000,999999);
    }

    /**
     * 创建订单
     * @param $data
     * @return bool
     */
    public function AddOrder($data){
        $data['orderno']=$this->createGoodsNo();
        if($this->load(['Order'=>$data]) && $this->validate())
        {
            $this->createtime=time();
            if($this->save())
            {
                return $this->getPrimaryKey();
            }
            return false;
        }
        return false;
    }

    /**
     *成功提交订单查询
     * @param $orderid
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getOrderInfo($orderid){
        $user=Yii::$app->session->get('user');

        $orderInfo=self::find()
            ->select('orderno,paytype,shipid,orderamount')
            ->where(['orderid'=>$orderid,'userid'=>$user['user_id'],'paystatus'=>self::IS_NOT_PAY])
            ->asArray()
            ->one();
        return $orderInfo;

    }

    /**
     * 订单与订单商品表一对多关系
     * @return \yii\db\ActiveQuery
     */
    public function getOrderGoods()
    {
        return $this->hasMany(OrderGoods::ClassName(),['orderid'=>'orderid']);
    }



}
