<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/27
 * Time: 11:52
 */
namespace app\module\controllers;
use yii\data\Pagination;
use  yii\web\Controller;
use Yii;
use app\models\Users;
use app\models\Member;
class UserController extends CommonController{
    public $layout='navcommon';

    /**
     * 会员列表显示
     * @return string
     */
    public function actionShow(){
        $pageSize=Yii::$app->params['page']['pageSize'];//配置页码
        $user=new Users();
        $query=Users::find()->joinWith('member');
        $page=new Pagination([
            'totalCount'=>$query->count(),
            'defaultPageSize'=>$pageSize,
        ]);
        $userList=$query->offset($page->offset)->limit($page->limit)->all();

        return $this->render('show',['page'=>$page,'userList'=>$userList]);


    }

    /**
     * 会员添加
     * @return string
     */
    public function actionInsert(){
        $request=Yii::$app->request;
        $user=new Users();
        if($request->isPost)
        {
            $post=$request->post();
            if($user->add($post))
            {
                $this->success('添加成功');
            }
            else
            {
                $this->error('添加失败');
            }
        }
        return $this->render('insert',['user'=>$user]);


    }

    /**
     * 会员删除
     * @param $user_id
     * @throws \Exception
     */
    public function actionDel($user_id){
        $res=Member::find()->where(['user_id'=>$user_id])->One();
        if($res)//信息表
        {
            $res->delete();
        }

        $user=Users::findOne($user_id)->delete();//主表
        if($user)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');

        }



        $this->redirect(['user/show']);
    }

}