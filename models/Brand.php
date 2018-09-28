<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/23
 * Time: 10:01
 */
namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
class Brand extends ActiveRecord{
    /**
     * 规则定义
     * @return array
     */
    public function rules(){
        return[

            ['brand_name','required','message'=>'品牌名不能为空'],
            ['brand_logo','required','message'=>'品牌logo没有上传'],
            ['brand_name','unique','message'=>'品牌名已存在'],
            ['brand_url','required','message'=>'品牌官网不能为空'],
            ['sort','integer','message'=>'排序必须为整数'],
            ['sort','default','value'=>100],
            ['is_show','default','value'=>0],
            ['brand_desc','required','message'=>'品牌描述不能为空'],
        ];

    }

    /**
     * 默认显示文本字段
     * @return array
     */
    public function attributeLabels(){
        return array(
            'brand_name'=>'品牌名：',
            'brand_logo'=>'品牌logo：',
            'brand_url'=>'品牌官网：',
            'is_show'=>'前台展示：',
            'brand_desc'=>'品牌描述：',
            'sort'=>'排序：',
        );

    }

    /**品牌下拉框
     * @return array
     */
    public function getBrandList(){
        $date=[];
        $brand=$this->find()->Asarray()->all();
        foreach($brand as $v)
        {
            $date[$v['brand_id']]=$v['brand_name'];
        }
        return $date;
    }

    /**
     * 前台品牌查询
     * @param $brand_id
     * @return static
     */
    public function getBrandOne($brand_id){
        return self::findOne($brand_id);

    }



}