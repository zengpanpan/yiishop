<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/21
 * Time: 9:14
 */
namespace app\models;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
class Admin extends ActiveRecord{
    public $remember;
    public $admin_rpwd;
    public function rules(){
        return [
            //[['admin_name','admin_pwd','remember'],'required','on'=>'login'],//应用场景
            ['remember','integer'],//3天免登陆checkbox
            ['admin_name','required','message'=>'姓名不能为空'],
            ['admin_name','unique','message'=>'姓名已存在','on'=>'register'],
            ['admin_pwd','required','message'=>'密码不能为空'],
            ['admin_rpwd','required','message'=>'确认密码不能为空','on'=>['register','update','findPwd']],
            ['email','required','message'=>'邮箱不能为空'],
            ['admin_rpwd','compare','compareAttribute' => 'admin_pwd','message'=>'两次密码不一致','on'=>['register','update','findPwd']],
            ['add_time','integer'],
            ['email','email','message'=>'邮箱不合法',],
            ['email','unique','message'=>'邮箱已存在','on'=>'register'],
        ];
    }
    public function attributeLabels(){//默认显示文本
        return array(
            'admin_name'=>'姓名 :',
            'admin_pwd'=>'密码 :',
            'admin_rpwd'=>'确认密码 :',
            'email'=>'邮箱 :',
            'remember'=>'3天免登陆',

        );
    }
    public function scenarios()//场景设置
    {

        return [
            'login'=>['admin_name','admin_pwd','remember'],
            'register'=>['admin_name','admin_pwd','admin_rpwd','email','add_time'],
            'update'=>['admin_pwd','admin_rpwd'],
            'find'=>['admin_name','email'],
            'findPwd'=>['admin_pwd','admin_rpwd'],
        ];
    }




    /*
     * 登陆验证
     *
    */
    public function checkLogin(){
        //检测账号密码
        $res=self::findOne(['admin_name'=>$this->admin_name,'admin_pwd'=>md5($this->admin_pwd)]);
        if($res===null)
        {
            return false;
        }
        else
        {
            $update=[
                'last_time'=>time(),
                'last_ip'=>\Yii::$app->request->userIp,
            ];
            self::updateAll($update,['admin_name'=>$this->admin_name]);
            return true;
        }
    }

    /**
     * 后台密码找回 用户名和邮箱效验
     * @param $data
     * @return array|bool|null|ActiveRecord
     */
    public function checkEmail($data)
    {
        if($this->load($data)&&$this->validate())
        {
            $res=Admin::find()
                ->where('admin_name=:name AND email=:email',[':name'=>$this->admin_name,':email'=>$this->email])
                ->one();
            if(is_null($res))
            {
                $this->addError('email','账户或邮箱不正确');
                return false;
            }
            $now=time();
            $token=$this->createToken($this->admin_name,$now);
            $res=\Yii::$app->mailer->compose('findpwd',['token'=>$token,'adminname'=>$this->admin_name,'timestamp'=>$now])
                ->setFrom('1530722579@qq.com')
                ->setTo($this->email)
                ->setSubject('必应商城找回密码')
                ->send();
            if($res)
            {
               return true;
            }
            else
            {
                $this->addError('email','抱歉!系统业务繁忙 请稍后重试');
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * 生成Token
     * @param $name
     * @param $time
     * @return string
     */
    public function createToken($name,$time)
    {
        return md5(md5($name).md5($time).md5(\Yii::$app->request->userIP));
    }

}
?>