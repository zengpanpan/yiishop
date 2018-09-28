<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/22
 * Time: 10:02
 */
namespace app\module\controllers;
use yii\web\Controller;
use app\models\Brand;
use app\models\Uploads;
use yii\web\UploadedFile;
use yii\data\Pagination;
use Yii;
class BrandController extends CommonController{
    public $layout='navcommon';
    public $request;
    public function init(){
        parent::init();//继承父类（自定义登陆状态及消息提示);
        $this->request=Yii::$app->request;

    }

    /**
     * 品牌列表显示
     * @return string
     */
    public function actionShow(){
        $model=new Brand();
        $query=$model->find();
        $pageSize=Yii::$app->params['page']['pageSize'];//配置页码数
        $page=new Pagination([//页码
                       'defaultPageSize' => $pageSize,
                       'totalCount' => $query->count(),
        ]);

        $brand=$query->offset($page->offset)->limit($page->limit)->all();

        return $this->render('show',['brand'=>$brand,'page'=>$page]);
    }

    /**
     * 品牌添加
     * @return string
     */
    public function actionInsert(){
        $request=Yii::$app->request;
        $model=new Brand();
        $models=new Uploads();//自定义文件上传方法
        if($request->isPost)
        {
            $post=$request->post();
            $models->brand_logo = UploadedFile::getInstance($model, 'brand_logo');
            $res=$models->upload();
            $post['Brand']['brand_logo']=$res;
            if($model->load($post)&&$model->save())
            {

                $this->success('添加成功');
            }
            else
            {
                $this->error('添加失败');
            }
        }
            return $this->render('insert',['model'=>$model]);

    }

    /**
     * 商品删除
     * @param $brand_id
     * @throws \Exception
     */
    public function actionDel($brand_id){
        $res=Brand::findOne($brand_id)->delete();
        if($res>0)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
        $this->redirect(['brand/show']);
    }

    /**
     * 商品修改
     * @param $brand_id
     * @return string
     */
    public function actionUpdate($brand_id){
        //$brand=new Brand();
        $model=Brand::findOne($brand_id);
        $models=new Uploads();
        $request=Yii::$app->request;
        if($request->isPost)
        {
            $post=$request->post();
            $models->brand_logo = UploadedFile::getInstance($model, 'brand_logo');
            if($models->brand_logo==null)//获取文件名
            {
                $post['Brand']['brand_logo']=$model['brand_logo'];
            }
            else
            {
                $res=$models->upload();
                $post['Brand']['brand_logo']=$res;

            }
            if($model->load($post)&&$model->save())
            {
                $this->success('修改成功');
            }
            else
            {
                $this->error('修改失败');
            }



        }
        return $this->render('update',['model'=>$model]);
    }

}
?>