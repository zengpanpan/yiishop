<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 22:52
 */
namespace app\module\controllers;
use app\models\Admin;
use Yii;
use yii\web\Controller;
class LoginController extends Controller{
    public $layout=false;
    //登陆
    public function actionLogin(){
        $request=Yii::$app->request;
        $model=new Admin(['scenario'=>'login']);
        $session=Yii::$app->session;
        if($request->isPost)
        {
            $post=$request->post();
            if($model->load($post)&&$model->validate())
            {
                if($model->checkLogin())
                {
                    $time=($model->remember)? 3*24*3600 : 0;//3天免登陆
                    session_set_cookie_params($time);

                    $session['admin']=[
                        'admin_name'=>$model->admin_name,
                        'status'=>true,
                    ];//存session值

                    $this->redirect(['index/index']);
                }
                else
                {
                    $model->addError('admin_pwd','账号或密码错误');
                    return $this->render('login',['model'=>$model]);

                }
            }
            else
            {

               return $this->render('login',['model'=>$model]);

            }
        }
        else
        {
            if($session->has('admin'))
            {
                $this->redirect(['index/index']);
            }
            return $this->render('login',['model'=>$model]);
        }
    }

    //退出
    public function actionLogout(){
        $session=Yii::$app->session;
        $session->remove('admin');
        $this->redirect(['login/login']);

    }

    /**
     * 管理员密码找回邮件通知
     * @return string
     */
    public function actionFindPwd()
    {
        $model=new Admin(['scenario'=>'find']);
        if(Yii::$app->request->isPost)
        {
            $post=Yii::$app->request->post();
            $sendEmail=$model->checkEmail($post);
            if($sendEmail)
            {
                $info['status']=1;
                $info['msg']='Email已发送 请注意查收';
            }
            else
            {
                $info['status']=0;
                $info['msg']='Email发送失败!';
            }
            Yii::$app->session->setFlash('info',$info);
        }
        return $this->render('find',['model'=>$model]);
    }

    /**
     * 找回密码 重置
     */
    public function actionUpdatePwd()
    {


        $model=new Admin(['scenario'=>'findPwd']);
        $request=Yii::$app->request;
        $timestamp=$request->get('timestamp');
        $admin_name=$request->get('adminname');
        $token=$request->get('token');
        if((time()-$timestamp)>5*60)//有效时间验证
        {

            $info['status']=0;
            $info['msg']='验证码已失效';
            Yii::$app->session->setFlash('info',$info);
            $this->redirect(['login/login']);
        }
        $myToken=$model->createToken($admin_name,$timestamp);
        if($myToken!=$token)//安全密钥验证
        {
            $info['status']=0;
            $info['msg']='链接参数有误!!';
            Yii::$app->session->setFlash('info',$info);
            $this->redirect(['login/login']);
        }
        if($request->isPost)//密码修改
        {
            $post=$request->post();
            if($model->load($post)&&$model->validate())
            {
                $adminInfo=Admin::find()->where('admin_name=:admin_name',[':admin_name'=>$admin_name])->One();
                $adminInfo->admin_pwd=md5($model->admin_pwd);
                if($adminInfo->save(false))
                {
                    $info['status']=1;
                    $info['msg']='修改成功,请登陆';
                }
                else
                {
                    $info['status']=0;
                    $info['msg']='修改失败！';
                }
                Yii::$app->session->setFlash('info',$info);

            }

        }
        return $this->render('resetpwd',['model'=>$model]);
    }

}