<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/7
 * Time: 8:51
 */
namespace app\controllers;
use app\models\Users;
use app\lib\Curl\MyCurl;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\web\response;
use Yii;
use yii\web\Controller;
class LoginController extends Controller{
    public $layout='unavcommon';
    private $user;
    private $request;
    public function beforeAction($action)// 要关闭 csrf 验证的操作ID(文件上传测试)
    {
        $notId=['upload'];
        $id=$action->id;
        if(in_array($id,$notId))
        {
            $action->controller->enableCsrfValidation=false;
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * 公用对象
     */
    public function init(){
        parent::init();
        $this->user=new Users();
        $this->request=Yii::$app->request;
    }

    /**
     * 前台登陆
     * @return string
     */
    public function actionLogin(){
        $user=$this->user;

        //登陆方法在member/ajaxlogin下和商品详情登陆共用
        return $this->render('login',['user'=>$user]);

    }

    /**
     * 文件上传测试
     * @return string
     */
    public function actionUpload()
    {
        $request=Yii::$app->request;
        if($request->isPost)
        {
            //var_dump($_FILES);die;

            $fileName=$_FILES['myfile']['name'];
            $path=$_FILES['myfile']['tmp_name'];
            //var_dump($path);die;
            // 用于签名的公钥和私钥
            $accessKey='jkDuEig_rM8Fd7LYVdluU0rMudBDTwFdhpqgjP1v';
            $secretKey='5i61t8LXLFYgUIjIGlMYnmFlINP6uP6wRsYnz7Cl';
            $auth=new Auth($accessKey,$secretKey);// 初始化签权对象
            $bucket = 'shop';// 空间名  https://developer.qiniu.io/kodo/manual/concepts
            $Token=$auth->uploadToken($bucket); // 生成上传Token
            $uploadMgr=new UploadManager();// 构建 UploadManager 对象
            //$paths=$path->extension;
            //var_dump($paths);die;
            $pathName=time().$fileName;//上传文件名(后缀);
            //echo 1;die;
            list($ret, $err)=$uploadMgr->putFile($Token,$pathName,$path);
            echo "====> Qiniu_Put result: \n";
            if ($err !== null) {
                var_dump($err);
            } else {
                var_dump($ret);
            }


        }

        return $this->render('upload');
    }
    /**
     * 用户注册
     * @return string
     */
    public function actionRegister(){
        $user=$this->user;
        if($this->request->isPost)
        {
            $post=$this->request->post();
            if(!isset($post['type']))//普通注册
            {

                if($user->add($post))
                {
                    $this->redirect(['login/login']);
                }
            }
            else//手机号注册
            {
                $user->scenario='phone';
                $info=Yii::$app->session->get('codeInfo');
                if($info['codetime']>=time())
                {
                    if($post['code']==$info['code']&&$post['user_phone']==$info['phone'])
                    {
                        if($user->adds($post))//入库
                        {
                            $this->redirect(['login/login']);
                        }

                    }
                    else
                    {
                        $user->addError('user_phone','验证码或手机号错误');

                    }

                }
                else
                {
                    $user->addError('code','验证码过期');
                }


            }


        }
        return $this->render('register',['user'=>$user]);
    }

    /**
     * 注册短信验证码
     */
    public function actionCodes(){
        $phone=Yii::$app->request->get('phone');
        $sms=Yii::$app->curl;
        $code=rand(1000,9999);
        $info=[
            'code'=>$code,
            'phone'=>$phone,
            'codetime'=>time()+3*60,
        ];
        Yii::$app->session->set('codeInfo',$info);
        $sms->param=[
            'app'       =>'sms.send',
            'tempid'    => $sms->tempid,
            'appkey'    => $sms->appkey,
            'sign'      => $sms->sign,
            'phone'     => $phone,
            'param'     => urlencode('code='.$code)
        ];
        $res=$sms->post();
        echo $res;exit();
    }

    /**
     * 登陆短信动态码发送
     */
    public function actionPhone(){
        $phone=Yii::$app->request->get('phone');
        $user=Users::find()->where(['user_phone'=>$phone])->One();
        Yii::$app->response->format=Response::FORMAT_JSON;
        if($user)
        {
            $code=rand(1000,9999);
            //Yii::$app->session->set('code',$code);

            $nowapi_parm['app']='sms.send';
            $nowapi_parm['tempid']='50926';
            $nowapi_parm['param']='code%3D'.$code;//短信内容
            $nowapi_parm['phone']=$user['user_phone'];
            $nowapi_parm['appkey']='20001';
            $nowapi_parm['sign']='817caeb0d058a5d3b993248450413f1e';
            $nowapi_parm['format']='json';
            $sms=Users::nowapi_call($nowapi_parm);
            if($sms)
            {
                Yii::$app->session->set('code',$code);
                Yii::$app->session->set('root',$user);
            }
            else
            {
                Yii::$app->response->data=['code'=>1,'msg'=>''];
                Yii::$app->end();
            }
        }
        else
        {
            Yii::$app->response->data=['code'=>0,'msg'=>''];
            Yii::$app->end();
        }

    }
    /**
     * 短信登陆
     */
    public function actionChecklogin()
    {
        $phone=Yii::$app->request->get('phone');
        $msm=Yii::$app->request->get('msm');
        $session_msm=Yii::$app->session->get('code');
        $user=Yii::$app->session->get('root');
        Yii::$app->response->format=Response::FORMAT_JSON;


            if($phone!=$user['user_phone']||$msm!=$session_msm)
            {
                Yii::$app->response->data=['code'=>0,'msg'=>'手机号或动态码错误'];
                Yii::$app->end();
            }
            else
            {
                    Yii::$app->session->set('user',$user);
                    Yii::$app->response->data=['code'=>1,'msg'=>''];
                    Yii::$app->end();
            }
    }
    /**
     * 邮件信息发送
     */
    public function actionEmail()
    {
        $user=$this->user;
        $user->scenario='email';
        $request=Yii::$app->request;
        if($request->isPost)
        {
            $post=$request->post();
            if($user->load($post)&&$user->validate())
            {
                if($user->checkEmail())
                {
                    $user->addError('email','发送成功!请注意查收');
                }
                else
                {
                    $user->addError('email','发送失败！');

                }
            }
        }
        return $this->render('email',['user'=>$user]);


    }

    /**
     * 用户邮箱修改密码
     * @return string
     */
    public function actionUpdatePwd()
    {
        $user=$this->user;
        $user->scenario='pwd';
        $request=Yii::$app->request;
        $timestamp=$request->get('timestamp');
        $user_name=$request->get('adminname');
        $token=$request->get('token');
        if((time()-$timestamp)>5*60)//有效时间验证
        {


            $this->redirect(['login/email']);
        }
        $myToken=$user->createToken( $user_name,$timestamp);
        if($myToken!=$token)//安全密钥验证
        {

            $this->redirect(['login/email']);
        }
        if($request->isPost)//密码修改
        {
            $post=$request->post();
            if($user->load($post)&&$user->validate())
            {
                $userInfo=Users::find()->where('user_name=:user_name',[':user_name'=>$user_name])->One();
                $userInfo->user_pwd=md5($user->user_pwd);
                if($userInfo->save(false))
                {
                    $user->addError('user_rpwd','修改成功！请重新登陆');
                }
                else
                {
                    $user->addError('user_rpwd','修改失败！');
                }

            }

        }
        return $this->render('pwd',['user'=>$user]);
    }

}