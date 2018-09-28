<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/24
 * Time: 23:53
 */
namespace app\models;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
use yii\data\Pagination;
class Goods extends ActiveRecord{
    const IS_DELETE=1;
    const NO_DELETE=0;
    const IS_HOT=1;
    const IS_ON_SALE=1;
    public function rules(){
        return [
            [['is_hot','is_best','is_new','is_on_sale'],'default','value'=>'0'],
            ['is_on_sale','required','message'=>'上架状态不能为空'],
            ['cate_id','required','message'=>'分类不能为空'],
            ['brand_id','required','message'=>'品牌不能为空'],
            ['goods_desc','required','message'=>'详情描述不能为空'],
            ['goods_img','required','message'=>'商品主图添加不合法'],
            [['promote_start_date','promote_end_date','goods_sn'],'safe'],
            ['goods_num','required','message'=>'商品库存不能为空'],
            ['goods_num','integer','message'=>'商品库存为整数'],
            ['shop_price','required','message'=>'本店价不能为空'],
            ['shop_price','double','message'=>'本店价必须位数字'],
            ['promote_price','double','message'=>'促销价必须位数字'],
            ['add_time','integer'],
            ['goods_name','required','message'=>'商品名称不能为空'],
            ['goods_name','unique','message'=>'商品名称已存在'],
            ['keywords','required','message'=>'推广热词不能为空'],

        ];
    }
    /**
     * 默认显示文本字段
     * @return array
     */
    public function attributeLabels(){
        return array(
            'goods_name'=>'商品名称：',
            'keywords'=>'推广热词：',
            'market_price'=>'市场价',
            'shop_price'=>'本店价',
            'promote_price'=>'促销价',
            'promote_start_date'=>'促销开始时间：',
            'promote_end_date'=>'促销结束时间：',
            'goods_num'=>'商品库存：',
            'goods_img'=>'商品主图：',
            'goods_desc'=>'详情描述：',
            'cate_id'=>'选择分类：',
            'brand_id'=>'选择品牌：',
            'is_new'=>'新品：',
            'is_hot'=>'热卖：',
            'is_best'=>'精品：',
            'is_on_sale'=>'上架：',
        );

    }

    /**
     * 生产商品号
     * @return string
     */
    public function getGoodsNum(){
        $str='QWERTYUIOPASDFGHJKLZXCVBNM';
        $num=substr(str_shuffle($str),-2).time().rand(10,99);
        $result=self::find()->select('goods_sn')->where(['goods_sn'=>$num])->One();
        if($result)
        {
            return $this->getGoodsNum();
        }
        return $num;
    }

    /**
     * 最热的前面15条（首页）
     * @return array|\yii\db\ActiveRecord[]
     */
    public  function getHotList(){
        return self::find()
            ->select('goods_name,keywords,shop_price,goods_img,shop_num,goods_id')
            ->where(['is_delete'=>self::NO_DELETE,'is_hot'=>self::IS_HOT,'is_on_sale'=>self::IS_ON_SALE])
            ->orderBy('goods_id')
            ->limit(15)
            ->asArray()
            ->all();
    }

    /**
     * 分类商品查询（分类详情页）
     * @param $cate_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public  function getGoodsList($cate_id){
        $where=['cate_id'=>$cate_id,'is_delete'=>self::NO_DELETE,'is_on_sale'=>self::IS_ON_SALE];
        $query=self::find();
        $page=new Pagination(//页码
            [
                'totalCount' => $query->where($where)->count(),
                'defaultPageSize'=>4,
            ]
        );
        $goodsList= $query
            ->select('keywords,shop_price,goods_id,goods_img,shop_num')
            ->offset($page->offset)
            ->limit($page->limit)
            ->where($where)
            ->orderBy('goods_id')
            ->asArray()
            ->all();
        $goodsCount= $query->where($where)->count();
        return ['list'=>$goodsList,'count'=>$goodsCount,'page'=>$page];
    }

    /**
     * 前台商品详情
     * @param $goods_id
     * @return static
     */
    public function getGoodOne($goods_id){
        return self::findOne($goods_id);

    }

    /**
     * 购物车商品促销，下线，等详情查询
     * @param $goods_id
     * @return array|null|ActiveRecord
     */
    public function getGoodInfo($goods_id){
        $res=self::find()
            ->select('goods_num,shop_price,is_on_sale,is_delete,promote_price,promote_start_date,promote_end_date')
            ->where(['goods_id'=>$goods_id])
            ->asArray()
            ->One();
        return $res;
    }

}