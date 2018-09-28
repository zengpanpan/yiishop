<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/5
 * Time: 21:41
 */
namespace app\models;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
class Region extends ActiveRecord{
    /**
     * 查询下级地区
     * @param $parent_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getNextRegion($parent_id){
        return self::find()->where(['parent_id'=>$parent_id])->asArray()->all();
    }

}