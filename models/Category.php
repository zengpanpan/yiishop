<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/22
 * Time: 16:28
 */
namespace app\models;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
class Category extends ActiveRecord{
    public function rules(){
        return[
            ['cate_name','required','message'=>'分类名不能为空'],
            ['cate_name','unique','message'=>'分类名已存在'],
            ['cate_name','trim'],
            ['sort','integer','message'=>'排序必须为数字'],
            ['pid','default','value'=>0],
            ['sort','default','value'=>100],
        ];

    }
    public function attributeLabels(){
        return array(
            'cate_name'=>'分类名:',
            'sort'=>'排序:',
            'pid'=>'上级分类:',
        );

    }



    /**
     * 查询所有分类列表
     * @return array|
     */
    public function getAllCateList(){
        $cateList=$this->find()->Asarray()->all();
        return $cateList;
    }

    /**
     * 获取带分类层级列表
     * @return array
     */
    public function getShow(){
        $cateList=$this->getAllCateList();
        $res=$this->getList($cateList);
        return $res;

    }

    /**
     * 处理分类层级排序关系
     * @param $data
     * @param int $pid 分类父id
     * @param int $cateId  筛选父类下的子类 主键id(仅修改下使用)
     * @param int $num  等级分类标识
     * @return array 分类数组排序调整
     */
    public function getList($data,$cateId=0,$pid=0,$num=1){
        static $list=[];
        if(is_array($data) && count($data)>0)
        {
            foreach($data as $key=>$v){
                if($v['pid']==$pid && $v['cate_id']!=$cateId){
                    $v['num']=$num;
                    $list[]=$v;
                    $this->getList($data,$cateId,$v['cate_id'],$num+1);
                }
            }
        }
        return $list;


    }

    /**
     * 分类下拉框
     * @param int $cateId 筛选父类下的子类 主键id(仅修改下使用)
     * @return array
     */
    public function dropDownList($cateId=0){
        $date=[];
        $All=$this->getAllCateList();
        $arr=$this->getList($All,$cateId);
        if(is_array($arr)&&count($arr)>0){
            foreach($arr as $key=>$v){
                $level=str_repeat('--',$v['num']*3);
                $date[$v['cate_id']]=$level.$v['cate_name'];
            }
        }
        return $date;
    }

    /**
     *前台商品分类数据获取
     * @return array
     */
    public function getCateList(){
        $cate=$this->getAllCateList();
        //return $cate;die;
        return $this->getMenu($cate);

    }
    /**
     *前台商品分类数据处理
     * @return array
     */
    public function getMenu($cate,$pid=0){
        $cateList=[];
        if(is_array($cate) && count($cate)>0)
        {
            foreach($cate as $key=>$val)
            {
                if($val['pid']==$pid)
                {

                    $cateList[$key]=$val;
                    $cateList[$key]['son']=$this->getMenu($cate,$val['cate_id']);

                }
            }
        }
        return $cateList;
    }

    /**
     * 获取分类ID集合
     * @param $cate_id
     * @return array
     */
    public function getAllSonId($cate_id){
        $arr=[];
        $CateList=$this->getAllCateList();
        $sonList=$this->getList($CateList,0,$cate_id);
        if(is_array($sonList)&&count($sonList)>0)
        {
            foreach($sonList as $key=>$v)
            {
                $arr[]=$v['cate_id'];
            }

        }
        $arr[]=$cate_id;
        return $arr;
    }

    /**
     * 获取面包屑导航
     * @param $pid
     * @param $cateOne
     * @return string
     */
    public function getBreadNavigation($pid,$cateOne='',$goods_name=''){
        $parentsName=[];
        $parents=$this->getParents($this->getAllCateList(),$pid);
        $breadList=array_reverse($parents);//数组反转
        $breadList[]=$cateOne;

        foreach($breadList as $v)//获取面包名字
        {
            $parentsName[$v['cate_id']]=$v['cate_name'];
        }

        $breadStr = '<a href="'.Url::to(['index/index']).'">全部 &#62; </a>';//拼接
        foreach($parentsName as $key=>$v)
        {
            $breadStr .= '<a href="'.Url::to(['category/category-list','cate_id'=>$key]).'">'.$v.' &#62; </a>';
        }
        $breadStr .=$goods_name;
        return $breadStr;

    }

    /**
     * 循环出父级
     * @param $CateList
     * @param $pid
     * @return array
     */
    public function getParents($CateList,$pid){
        static $parents=[];
        if(count($CateList)>0)
        {
            foreach($CateList as $v)
            {
                if($v['cate_id']==$pid)
                {
                    $parents[]=$v;
                    $this->getParents($CateList,$v['pid']);
                }
            }
        }
        return $parents;

    }

    /**
     * 获取单个分类
     * @param $id
     * @return static
     */
    public function getOneCate($id){
        return self::findOne($id);

    }



}