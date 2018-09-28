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
                <h3>分类列表</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="" />

                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->
                    <div class="ui-dropdown">
                        <div class="head" data-toggle="tooltip" title="Click me!">
                            分类名
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

                    <a href="<?= Url::to(['shop/insert']);?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        分类添加
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <?=  $this->render('/common/message');?>
                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th class="span10 sortable">
                            分类名
                        </th>


                        <th class="span2 sortable align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php foreach($cateList as $v):?>
                    <tr class="first">
                        <td>
                       <?= str_repeat("|---",($v['num']-1)*3)?><?= $v['cate_name'];?>
                        </td>


                        <td class="align-right">
                            <?= Html::a('删除',['del','cate_id'=>$v['cate_id']],['class'=>'btn btn-danger']);?>
                            <?= Html::a('修改',['update','cate_id'=>$v['cate_id']],['class'=>'btn btn-primary']);?>

                        </td>
                    </tr>
                  <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="pagination pull-right">
                <ul>

                </ul>
            </div>

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
