<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;

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


    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>


    

	<!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>品牌列表</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="品牌名" />
                        
                        <div class="ui-dropdown">
                            <button class="btn">Search</button>
                        </div>
    
                        <a href="<?= Url::to(['brand/insert']);?>" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            添加新品牌
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                        <?=  $this->render('/common/message');?>
                            <tr>
                                <th class="span4 sortable">
                                    品牌名/简短描述
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>排序
                                </th>                                
                                <th class="span2 sortable">
                                    <span class="line"></span>是否展示
                                </th>                                                                                                
                                <th class="span3 sortable align-right">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($brand as $v):?>
                        <!-- row -->
                        <tr class="first">
                            <td>
                                <img src="/<?= $v['brand_logo']?>" class="img-circle avatar thumbnail hidden-phone" />
                                <a href="#" class="name"><?= $v['brand_name'];?></a>
                                <span class="subtext"><?= $v['brand_desc'];?></span>
                            </td>
                            <td><?= $v['sort'];?></td>
                            <td>
                                <?php $show=['未展示','展示中'];echo $show[$v->is_show];?>
                            </td>
                            <td class="align-right">
                                <?= Html::a('删除',['del','brand_id'=>$v['brand_id']],['class'=>'btn btn-primary']);?>
                                <?= Html::a('修改',['update','brand_id'=>$v['brand_id']],['class'=>'btn btn-success']);?>

                            </td>
                        </tr>
                        <!-- row -->

                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
                <div class="pagination pull-right">
                    <ul>
                        <?= LinkPager::widget(
                            ['pagination'=>$page,
                                'firstPageLabel'=>'首页',
                                'prevPageLabel'=>'上一页',
                                'nextPageLabel'=>'下一页',
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