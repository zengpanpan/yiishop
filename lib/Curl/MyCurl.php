<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/13
 * Time: 14:28
 */
namespace app\lib\Curl;
use yii\base\Exception;
class MyCurl
{
    private $ch;         // CURL 对象
    private $url;        // API  地址
    private $param=[];   // API  参数
    private $info=[];    //CURL执行信息

    /**
     *
     * MyCurl constructor.
     * @param $url
     * @param $param
     *
     */
    public function __construct($url='',$param=[])
    {
        if(!empty($url))
        {
            $this->url=$url;
        }
        if(!empty($param))
        {
            $this->param=$param;
        }
        $this->ch=curl_init();//初始化curl
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);//默认不输出

    }

    /**
     * 判断数组还是字符串（完成完整路径）
     * @param $param
     * @return string
     */
    public function getfullurl($param)
    {
        if(is_array($param)&&count($param)>0)
        {
            $fullurl='';
            foreach($param as $key=>$v)
            {
                $fullurl.=$key.'='.$v.'&';
            }

            return $this->url.'?'.substr($fullurl,0,-1);
        }
        else
        {
            return $this->url.'?'.$param;
        }
    }

    /**
     * get方式调用API接口
     * @return mixed
     */
    public function get()
    {
        if($this->validateParam())
        {
            $fullurl=$this->getfullurl($this->param);
            curl_setopt($this->ch,CURLOPT_URL,$fullurl);

            return $this->exec();
        }
    }



    /**
     * post方式调用API接口
     * @return mixed
     */
    public function post()
    {
        if($this->validateParam())
        {

            curl_setopt($this->ch,CURLOPT_URL,$this->url);//接口地址
            curl_setopt($this->ch,CURLOPT_POST,1);//开启post
            curl_setopt($this->ch,CURLOPT_POSTFIELDS,$this->param);//赋值
            return $this->exec();
        }
    }
    /**
     * 执行CURL
     * @return bool|mixed
     */
    private function exec()
    {
        try
        {
            $result=curl_exec($this->ch);
            if(curl_errno($this->ch))
            {
                throw new Exception(curl_errno($this->ch));
            }
            $this->info=curl_getinfo($this->ch);
            return $result;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * 校验API接口参数
     * @return bool
     */
    private function validateParam()
    {
      try
      {
          if(empty($this->param))
          {
              throw new Exception('API parameter can not be null.');
          }
          if(empty($this->url))
          {
              throw new Exception('API url can not be null.');
          }
          return true;
      }
      catch(Exception $e)
      {
          echo $e->getMessage();
          return false;
      }
    }

    /**
     * 获取CURL执行信息
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * param赋值
     * @param $name
     * @param $value
     */
    public function __set($name,$value)
    {
        $this->$name=$value;
    }

    /**
     * param取值
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }
    /**
     * 关闭资源
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}
?>