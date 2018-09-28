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
use yii\data\Pagination;
use yii\web\Controller;
class AdminController extends CommonController{
    public $layout='navcommon';

    /**
     * @return string
     * @throws \管理员添加
     */
    public function actionInsert(){
        $admin=new Admin(['scenario'=>'register']);
        $request=Yii::$app->request;
        if($request->isPost)
        {
            $post=$request->post();
            $post['Admin']['add_time']=time();
            if($admin->load($post)&&$admin->Validate())
            {
                $admin['admin_pwd']=md5($admin->admin_pwd);
                $admin['admin_rpwd']=md5($admin->admin_rpwd);
                $res=$admin->insert();
                if($res)
                {
                    $this->success('添加成功');
                    $admin['admin_pwd']='';
                    $admin['admin_rpwd']='';
                    $admin['email']='';
                    $admin['admin_name']='';
                }
                else
                {
                   $this->error('添加失败');

                }
                return $this->render('insert',['admin'=>$admin]);
            }
            else
            {
                return $this->render('insert',['admin'=>$admin]);
            }
        }
        else
        {

            return $this->render('insert',['admin'=>$admin]);
        }
    }
    /**
     * 管理员列表
     */
    public function actionShow(){

        $pageSize=Yii::$app->params['page']['pageSize'];//配置每页显示条数
        $page=new Pagination(
            ['totalCount'=>Admin::find()->count(),'defaultPageSize'=>$pageSize
            ]
        );//页码
        $adminList=Admin::find()->offset($page->offset)->limit($page->limit)->all();
        return $this->render('show',['pages'=>$page,'adminList'=>$adminList]);
    }
    /**
     * 密码修改
     */
    public function actionUpdatePwd(){
        $admin=new Admin(['scenario'=>'update']);
        $session=Yii::$app->session;
        $request=Yii::$app->request;
        $admin_name=$session['admin']['admin_name'];//取出session的name值
        if($request->isPost)
        {
            $post=$request->post();
            if($admin->load($post) && $admin->Validate())
            {
                $update=[
                    'admin_pwd'=>md5($admin->admin_pwd),//修改字段
                ];
                $res=$admin->updateAll($update,['admin_name'=>$admin_name]);//按条件修改
                if($res>0)
                {
                    $this->success('修改成功');
                    $admin['admin_pwd']='';
                    $admin['admin_rpwd']='';
                }
                else
                {
                    $this->error('修改失败');
                }

            }

        }

            return $this->render('update',['admin'=>$admin,'admin_name'=>$admin_name]);

    }




}