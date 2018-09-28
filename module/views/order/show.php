<?php
use app\models\Order;
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

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/ui-elements.css" type="text/css" media="screen" />

    <!-- open sans font -->

    <!--[if lt IE 9]>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>




<!-- main container -->
<div class="content">

    <!-- settings changer -->
    <div class="skins-nav">
        <a href="#" class="skin first_nav selected">
            <span class="icon"></span><span class="text">Default</span>
        </a>
        <a href="#" class="skin second_nav" data-file="css/skins/dark.css">
            <span class="icon"></span><span class="text">Dark skin</span>
        </a>
    </div>

    <div class="container-fluid">

        <div id="pad-wrapper">
            <?=$this->render('/common/message');?>
            <div class="row-fluid section btns">
                <!-- flat buttons -->
                <!-- these styles are located in css/elements.css -->
                <!-- they also include .small and .large classes to change their size -->
                <h4 class="title">订单信息</h4>
                <div class="span6">
                    <table class="table table-hover">
                        <tr>
                            <td><code>订单编号</code></td>
                            <td><?= $orderList['orderno'];?></td>
                        </tr>
                        <tr>
                            <td><code>当前状态</code></td>
                            <td><?= Order::$orderStatus[$orderList['status']];?></td>
                        </tr>
                        <tr>
                            <td><code>支付状态</code></td>
                            <td><?= ($orderList['paystatus'])?'已支付':'未支付';?></td>
                        </tr>
                        <tr>
                            <td><code>配送状态</code></td>
                            <td><?= ($orderList['shipstatus'])?'已配送':'未配送';?></td>
                        </tr>

                    </table>
                </div>
                <!-- end flat buttons -->

                <!-- controls showcase -->
                <div class="span5">
                    <table class="table table-hover">
                        <tr >
                            <td>收货人</td>
                            <td><?=$orderList['consignee'];?></td>
                        </tr>
                        <tr>
                            <td>手机</td>
                            <td><?=$orderList['mobile'];?></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>1530722579@qq.com</td>
                        </tr>
                        <tr >
                            <td>详细地址</td>
                            <td><?=$address;?><?=$orderList['address'];?></td>
                        </tr>
                    </table>
                </div>
                <!-- end controls showcase -->
            </div>
            <div class="row-fluid section btns">
                <!-- glow buttons -->
                <!-- these styles are located in css/elements.css -->
                <!-- they also include .small and .large classes to change their size -->
                <h4 class="title">订单商品</h4>
                <div class="span11">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>商品编号</th>
                            <th>商品名</th>
                            <th>商品原价</th>
                            <th>购买价</th>
                            <th>购买量</th>
                        </tr>
                        </thead>
                        <!--BING提示循环开始处-->
                        <?php foreach($goodsList as $v):?>
                        <tr class="first">
                            <td><?=$v['goods_sn'];?></td>
                            <td><a href=""><?=$v['goods_name'];?></a></td>
                            <td><?=$v['goods_price'];?>￥</td>
                            <td><?=$v['shop_price'];?>￥</td>
                            <td><?=$v['buy_num'];?></td>
                        </tr>
                        <?php endforeach;?>
                        <!--BING提示循环结束处-->


                    </table>
                </div>
                <!-- end glow buttons -->

            </div>
            <div class="row-fluid section btns">
                <h4 class="title">订单操作日志</h4>
                <div class="span10">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>时间</th>
                            <th>操作人员</th>
                            <th>动作</th>
                            <th>结果</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <!--BING提示循环开始处-->
                        <?php foreach($actionList as $v):?>
                        <tr class="first">
                            <td><?=date('Y/m/d H:i:s',$v['actiontime']);?></td>
                            <td><?=$v['admin'];?></td>
                            <td><?=$v['action'];?></td>
                            <td><?=$v['result'];?></td>
                            <td><?=$v['note'];?></td>
                        </tr>
                        <?php endforeach;?>
                        <!--BING提示循环结束处-->


                    </table>
                </div>
                <div class="span3 pull-right">

                    <?php if($orderList['paystatus']==Order::IS_NOT_PAY):?>
                    <a class="btn-flat" href="<?=Url::to(['order/pay','orderid'=>$orderList['orderid'],'act'=>'pay']);?>">支付</a>
                    <?php endif;?>

                    <?php if($orderList['paystatus']==Order::IS_PAY && $orderList['shipstatus']==Order::IS_NOT_SHIP):?>
                    <a class="btn-flat" href="<?=Url::to(['order/pay','orderid'=>$orderList['orderid'],'act'=>'ship']);?>">去发货</a>
                    <?php endif;?>

                    <?php if($orderList['shipstatus']==Order::IS_SHIP&& $orderList['status']!=Order::IS_SUCCESS_STATUS):?>
                    <a class="btn-flat" href="<?=Url::to(['order/pay','orderid'=>$orderList['orderid'],'act'=>'finish']);?>">完成</a>
                    <?php endif;?>

                    <?php if($orderList['status']!=Order::IS_SUCCESS_STATUS):?>
                    <a class="btn-flat" >取消订单</a>
                    <?php endif;?>
                </div>
            </div>
            <div class="separator">

            </div>
            <!-- custom dialogs -->

        </div>
        <!-- end custom dialogs -->


    </div>
</div>

<!-- end main container -->


<!-- scripts -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="js/bootstrap.datepicker.js"></script>

<!-- call all plugins -->
<script src="js/theme.js"></script>


</body>
</html>