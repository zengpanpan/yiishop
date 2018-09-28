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
class Photo extends ActiveRecord{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['img', 'required'],
            [['goods_id'], 'integer'],
            [['img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'photo_id' => 'Photo ID',
            'goods_id' => 'Goods ID',
            'img' => '相册图',
        ];
    }

    /**
     * 获取相册列表
     */
    public function getPhotoList($goods_id)
    {
        $photo=Photo::find()
            ->where(['goods_id'=>$goods_id])
            ->asArray()
            ->one();
        return $photo;
    }


}
