
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
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
                    <h3>商品列表</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="商品名" />
                        
                        <div class="ui-dropdown">
                            <button class="btn">Search</button>
                        </div>
    
                        <a href="<?= Url::to(['goods/add']);?>" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            发布新商品
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <?= $this->render('/common/message');?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    商品名
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>是否上架
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>是否热卖
                                </th>                                
                                <th class="span1 sortable">
                                    <span class="line"></span>单价
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>库存
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>是否促销
                                </th>                                
                                <th class="span1 sortable">
                                    <span class="line"></span>促销价
                                </th>                                                                                                
                                <th class="span1 sortable align-right">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($goodsList as $v):?>
                        <tr class="first">
                            <td>
                                <img src="/<?= $v['goods_img'];?>" class="img-circle avatar hidden-phone" />
                                <a href="user-profile.html" class="name"><?= $v['goods_name'];?></a>
                                <span class="subtext"><?= $v['keywords'];?></span>
                            </td>
                            <td>
                                <?php $date=['下架','上架'];echo $date[$v->is_on_sale];?>
                            </td>
                            <td>
                                <?php $show=['否','是'];echo $show[$v->is_hot];?>
                            </td>
                            <td>
                                <?= $v['shop_price'];?>￥
                            </td>
                            <td>
                               <?= $v['goods_num'];?>
                            </td>
                            <td>
                                是
                            </td>
                            <td>
                                <?= $v['promote_price'];?>￥
                            </td>
                            <td class="align-right">
                                <?= Html::a('修改',['update','goods_id'=>$v['goods_id']]);?>
                                <?= Html::a('相册',['photo-list','goods_id'=>$v['goods_id'],'goods_name'=>$v['goods_name'],'goods_img'=>$v['goods_img']]);?>
                                <?= Html::a('回收站',['recycle','goods_id'=>$v['goods_id']]);?>
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
                           ['pagination'=>$page]
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