<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/21
 * Time: 21:17
 */
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <title>必应商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<base href="admin/">
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- libraries -->
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/user-list.css" type="text/css" media="screen" />

    <!-- open sans font -->

    <!--[if lt IE 9]>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>




<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>会员列表</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="" />

                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->
                    <div class="ui-dropdown">
                        <div class="head" data-toggle="tooltip" title="Click me!">
                            会员名字
                            <i class="arrow-down"></i>
                        </div>
                        <div class="dialog">
                            <div class="pointer">
                                <div class="arrow"></div>
                                <div class="arrow_border"></div>
                            </div>
                            <div class="body">
                                <p class="title">
                                    Show users where:
                                </p>
                                <div class="form">
                                    <select>
                                        <option />Name
                                        <option />Email
                                        <option />Number of orders
                                        <option />Signed up
                                        <option />Last seen
                                    </select>
                                    <select>
                                        <option />is equal to
                                        <option />is not equal to
                                        <option />is greater than
                                        <option />starts with
                                        <option />contains
                                    </select>
                                    <input type="text" />
                                    <a class="btn-flat small">Add filter</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?= Url::to(['user/insert']);?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        会员员添加
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <?=  $this->render('/common/message');?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span3 sortable">
                            会员账号/姓名
                        </th>
                        <th class="span2 sortable">
                            状态
                        </th>

                        <th class="span1 sortable">
                            <span class="line"></span>手机号
                        </th>
                        <th class="span1 sortable ">
                            <span class="line"></span>邮箱
                        </th>
                        <th class="span1 sortable ">
                            <span class="line"></span>性别
                        </th>
                        <th class="span2 sortable ">
                            <span class="line"></span>最后登陆时间
                        </th>
                        <th class="span2 sortable ">
                            <span class="line"></span>注册时间
                        </th>
                        <th class="span2 sortable align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach($userList as $v):?>
                    <tr class="first">
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.html" class="name"><?= $v['user_name'];?></a>
                            <span class="subtext"><?= (!empty($v->member->truename)) ? $v->member->truename :'未填写';?></span>
                        </td>
                        <td>
                            <?= ($v['status']) ?'已锁定':'正常';?>
                        </td>

                        <td>
                            <?= (!empty($v->user_phone)) ? $v->user_phone :'未填写';?>
                        </td>
                        <td>
                            <?= (!empty($v->email)) ? $v->email :'未填写';?>

                        </td>

                        <td>
                            <?php
                                if(isset($v->member->sex)&&$v->member->sex==1)
                                {
                                    echo '男';
                                }
                                elseif(isset($v->member->sex)&&$v->member->sex==0)
                                {
                                     echo '女';
                                }
                                else
                                {
                                    echo '中性';
                                }

                            ?>

                        </td>
                        <td>
                            <?= (!empty($v->last_time)) ? date('Y/m/d H:i:s',$v->last_time) :'未登陆';?>

                        </td>
                        <td>
                            <?= date('Y/m/d H:i:s',$v['reg_time']);?>

                        </td>
                        <td class="align-right">
                            <?= Html::a('删除',['del','user_id'=>$v['user_id']],['class'=>'btn btn-primary']);?>
<!--                            --><?//= Html::a('修改',['update','admin_id'=>$v['admin_id']],['class'=>'btn btn-success']);?>
                        </td>
                    </tr>
                    <?php endforeach;?>

                    </tbody>
                </table>
            </div>
            <div class="pagination pull-right">
                <ul>
                    <?= LinkPager::widget(
                        ['pagination'=>$page,
                            'firstPageLabel'=>'首页',
                            'prevPageLabel'=>'下一页',
                            'nextPageLabel'=>'上一页',
                            'lastPageLabel'=>'尾页',

                        ]
                    );?>
                </ul>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->


<!-- scripts -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/theme.js"></script>

</body>
</html>
