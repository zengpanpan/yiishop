<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/5
 * Time: 20:25
 */
namespace app\models;
use yii\rest\ActiveController;
use Yii;
use yii\db\ActiveRecord;
class Address extends ActiveRecord{
    const IS_DEFAULT=1;

    /**
     * 会员收货地址验证
     * @return array
     */
    public function rules(){
        return[
            [['consignee','country','province','city','district','address','zipcode','mobile','email'],'required'],
            ['email','email'],
            [['userid','isdefault'],'safe'],
            ['zipcode','string','length'=>6],
            ['mobile','match','pattern'=>'/^[1][358][0-9]{9}$/'],

        ];
    }

    /**
     * 验证默认名称
     */
    public function attributeLabels(){
        return array(
            'consignee'=>'收货人',
            'country'=>'国家',
            'province'=>'省',
            'city'=>'市',
            'district'=>'区',
            'address'=>'详细地址',
            'zipcode'=>'邮编',
            'mobile'=>'手机号',
            'email'=>'邮箱',
        );

    }

    /**
     * 查询默认地址
     * @return array|mixed|null|ActiveRecord
     */
    public function getDefaultAddress(){
        $defaultAddress=Yii::$app->session->get('defaultAddress');
        if(!$defaultAddress)
        {
            $user=Yii::$app->session->get('user');
            $address= self::find()
                ->where(['userid'=>$user['user_id'],'isdefault'=>self::IS_DEFAULT])
                ->asArray()
                ->one();
            if($address)//数据库有才追加
            {
                $regionArr = Region::find()
                    ->select('region_name')
                    ->where(['region_id' => [$address['province'], $address['city'], $address['district']]])
                    ->asArray()
                    ->all();
                $address['fullarea'] = implode('', array_column($regionArr, 'region_name'));//取地名粘合
            }

            return $address;
        }

        $regionArr = Region::find()//session中追加
            ->select('region_name')
            ->where(['region_id' => [$defaultAddress['province'], $defaultAddress['city'], $defaultAddress['district']]])
            ->asArray()
            ->all();
        $defaultAddress['fullarea'] = implode('', array_column($regionArr, 'region_name'));//取地名粘合


        return $defaultAddress;

    }

    /**
     * 后台个人订单信息地址查询
     * @param $address
     * @return string
     */
    public static  function getAddress($address)
    {
        $regionArr = Region::find()
            ->select('region_name')
            ->where(['region_id' => [$address['province'], $address['city'], $address['district']]])
            ->asArray()
            ->all();
        return  implode('', array_column($regionArr, 'region_name'));//取地名粘合
    }

}