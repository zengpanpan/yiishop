<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/23
 * Time: 10:01
 */
namespace app\models;
use yii\base\Exception;
use yii\base\Model;
use Qiniu\Auth;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
class Uploads extends Model{
    public $brand_logo;
    private $rootPath='uploads';
    private $auth;
    private $bucket;
    private $qiniu;

    /**
     * 初始化使用对象
     * Uploads constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $ak=Yii::$app->qiniu->accessKey;
        $sk=Yii::$app->qiniu->secretKey;
        $this->auth=new Auth($ak,$sk);
        $this->bucket=Yii::$app->qiniu->bucket;
        $this->qiniu=Yii::$app->qiniu;
    }

    /**
     * 文件上传规则
     * @return array
     */
    public function rules()
    {
        return [
            ['brand_logo', 'file','skipOnEmpty' => false, 'extensions' => 'png, jpg , jpeg , gif'],

        ];

    }

    /**
     * 上传至七牛云
     * @return string
     */
    public function pubFile(){
        $file=$this->QiNiuFileName();
        $Token=$this->auth->uploadToken($this->bucket); // 生成上传Token
        if(is_array($file))
        {
            $result=[];
            foreach($file as $key=>$v)
            {

                list($result[$key], $err)=$this->qiniu->putFile($Token,$v['name'],$v['temp_name']);
            }
            if($err !== null)
            {
                return null;
            }
            else
            {
                $key=[];
                foreach($result as $k=>$v)
                {
                    $key[$k]=$v['key'];
                }
                return $key;
                //return ArrayHelper::toArray($result);
            }

        }

    }
    /**
     * 获取文件上传名和临时路径(七牛云)
     * @return bool
     */
    private function QiNiuFileName()
    {
        $file=$this->brand_logo;
        $files=ArrayHelper::toArray($file);
        if(is_array($files)&&count($files)>0)
        {
            $file=[];
            foreach($files as $key=>$v)
            {
                
                $file[$key]['name']=date('YmdHiS').uniqid().rand(10000,99999);
                $file[$key]['temp_name']=$v['tempName'];
            }
            return $file;

        }
        else
        {
            return false;
        }

    }
    /**
     * 1.目录规划 2017/02/25/
     * 2.文件名
     */

    private function createPathAndFileName()
    {
        $filePath = $this->rootPath . '/' . date('Y') . '/' . date('m') .'/' . date('d') .'/';
        try
        {
            if(!file_exists($filePath))
            {
                if(mkdir($filePath,0777,true) === false)
                {
                    throw new Exception('目录创建失败');
                }
            }

        }
        catch (Exception $e)
        {
            exit($e->getMessage());
        }

        // 生成文件名

        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $fileName = substr(str_shuffle($str),-15) . '.' . $this->brand_logo->extension;

        $file = $filePath . $fileName;
        if(file_exists($file))
        {
            return $this->createPathAndFileName();
        }
        return $file;
    }

    /**
     * 本地文件上传
     *
     * @return bool|string
     */
    public function upload()
   {
        if ($this->validate()) {
            $file = $this->createPathAndFileName();
            $this->brand_logo->saveAs($file);
            return $file;
        }
        else
        {
                return null;
        }

   }


}
