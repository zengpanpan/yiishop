<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pay_log}}".
 *
 * @property integer $logid
 * @property integer $orderid
 * @property string $paymount
 * @property string $detail
 * @property string $paytype
 */
class PayLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid', 'paymount', 'detail', 'paytype'], 'required'],
            [['logid', 'orderid'], 'integer'],
            [['paymount'], 'number'],
            [['detail'], 'string'],
            [['paytype'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'logid' => 'Logid',
            'orderid' => '订单id',
            'paymount' => '支付价',
            'detail' => '支付宝回参',
            'paytype' => '支付方式',
        ];
    }

    /**
     * 支付日志添加
     * @param $orderid
     * @param $paymount
     * @param $paytype
     * @param $detail
     * @return bool
     */
    public function addLog($orderid,$paymount,$paytype,$detail){
        $data=['orderid'=>$orderid,'paymount'=>$paymount,'paytype'=>$paytype,'detail'=>$detail];
        if($this->load(['PayLog'=>$data])&&$this->validate())
        {
            return $this->save();
        }
        return false;

    }
}
