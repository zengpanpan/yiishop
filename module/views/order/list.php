<?php
use yii\widgets\LinkPager;
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
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

    <!-- navbar -->
<!--    <div class="navbar navbar-inverse">-->
<!--        <div class="navbar-inner">-->
<!--            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--            </button>-->
<!--            -->
<!--            <a class="brand" href="index.html" style="font-weight:700;font-family:Microsoft Yahei">必应商城 - 后台管理</a>-->
<!---->
<!--            <ul class="nav pull-right">                -->
<!--                <li class="hidden-phone">-->
<!--                    <input class="search" type="text" />-->
<!--                </li>-->
<!--                <li class="notification-dropdown hidden-phone">-->
<!--                    <a href="#" class="trigger">-->
<!--                        <i class="icon-warning-sign"></i>-->
<!--                        <span class="count">6</span>-->
<!--                    </a>-->
<!--                    <div class="pop-dialog">-->
<!--                        <div class="pointer right">-->
<!--                            <div class="arrow"></div>-->
<!--                            <div class="arrow_border"></div>-->
<!--                        </div>-->
<!--                        <div class="body">-->
<!--                            <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
<!--                            <div class="notifications">-->
<!--                                <h3>你有 6 个新通知</h3>-->
<!--                                <a href="#" class="item">-->
<!--                                    <i class="icon-signin"></i> 新用户注册-->
<!--                                    <span class="time"><i class="icon-time"></i> 13 分钟前.</span>-->
<!--                                </a>-->
<!--                                <a href="#" class="item">-->
<!--                                    <i class="icon-signin"></i> 新用户注册-->
<!--                                    <span class="time"><i class="icon-time"></i> 18 分钟前.</span>-->
<!--                                </a>-->
<!--                                <a href="#" class="item">-->
<!--                                    <i class="icon-signin"></i> 新用户注册-->
<!--                                    <span class="time"><i class="icon-time"></i> 49 分钟前.</span>-->
<!--                                </a>-->
<!--                                <a href="#" class="item">-->
<!--                                    <i class="icon-download-alt"></i> 新订单-->
<!--                                    <span class="time"><i class="icon-time"></i> 1 天前.</span>-->
<!--                                </a>-->
<!--                                <div class="footer">-->
<!--                                    <a href="#" class="logout">查看所有通知</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                -->
<!--                <li class="notification-dropdown hidden-phone">-->
<!--                    <a href="#" class="trigger">-->
<!--                        <i class="icon-envelope-alt"></i>-->
<!--                    </a>-->
<!--                    <div class="pop-dialog">-->
<!--                        <div class="pointer right">-->
<!--                            <div class="arrow"></div>-->
<!--                            <div class="arrow_border"></div>-->
<!--                        </div>-->
<!--                        <div class="body">-->
<!--                            <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
<!--                            <div class="messages">-->
<!--                                <a href="#" class="item">-->
<!--                                    <img src="img/contact-img.png" class="display" />-->
<!--                                    <div class="name">Alejandra Galván</div>-->
<!--                                    <div class="msg">-->
<!--                                        There are many variations of available, but the majority have suffered alterations.-->
<!--                                    </div>-->
<!--                                    <span class="time"><i class="icon-time"></i> 13 min.</span>-->
<!--                                </a>-->
<!--                                <a href="#" class="item">-->
<!--                                    <img src="img/contact-img2.png" class="display" />-->
<!--                                    <div class="name">Alejandra Galván</div>-->
<!--                                    <div class="msg">-->
<!--                                        There are many variations of available, have suffered alterations.-->
<!--                                    </div>-->
<!--                                    <span class="time"><i class="icon-time"></i> 26 min.</span>-->
<!--                                </a>-->
<!--                                <a href="#" class="item last">-->
<!--                                    <img src="img/contact-img.png" class="display" />-->
<!--                                    <div class="name">Alejandra Galván</div>-->
<!--                                    <div class="msg">-->
<!--                                        There are many variations of available, but the majority have suffered alterations.-->
<!--                                    </div>-->
<!--                                    <span class="time"><i class="icon-time"></i> 48 min.</span>-->
<!--                                </a>-->
<!--                                <div class="footer">-->
<!--                                    <a href="#" class="logout">View all messages</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">-->
<!--                        账户管理-->
<!--                        <b class="caret"></b>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="personal-info.html">个人信息管理</a></li>-->
<!--                        <li><a href="#">修改密码</a></li>-->
<!--                        <li><a href="#">订单管理</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="settings hidden-phone">-->
<!--                    <a href="personal-info.html" role="button">-->
<!--                        <i class="icon-cog"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="settings hidden-phone">-->
<!--                    <a href="signin.html" role="button">-->
<!--                        <i class="icon-share-alt"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>            -->
<!--        </div>-->
<!--    </div>-->
<!--    <!-- end navbar -->
<!---->
<!--    <!-- sidebar -->
<!--    <div id="sidebar-nav">-->
<!--        <ul id="dashboard-menu">-->
<!--            <li class="active">-->
<!--                <div class="pointer">-->
<!--                    <div class="arrow"></div>-->
<!--                    <div class="arrow_border"></div>-->
<!--                </div>-->
<!--                <a href="index.html">-->
<!--                    <i class="icon-home"></i>-->
<!--                    <span>后台首页</span>-->
<!--                </a>-->
<!--            </li>            -->
<!--            <li>-->
<!--                <a href="chart-showcase.html">-->
<!--                    <i class="icon-signal"></i>-->
<!--                    <span>统计</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-group"></i>-->
<!--                    <span>用户管理</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                    <li><a href="user-list.html">用户列表</a></li>-->
<!--                    <li><a href="new-user.html">加入新用户</a></li>-->
<!--                    <li><a href="user-profile.html">用户信息</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-edit"></i>-->
<!--                    <span>表单</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                    <li><a href="form-showcase.html">基本表单</a></li>-->
<!--                    <li><a href="form-wizard.html">步骤表单</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="gallery.html">-->
<!--                    <i class="icon-picture"></i>-->
<!--                    <span>相册管理</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="calendar.html">-->
<!--                    <i class="icon-calendar-empty"></i>-->
<!--                    <span>日历事件管理</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="tables.html">-->
<!--                    <i class="icon-th-large"></i>-->
<!--                    <span>表格</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            -->
<!--            <li>-->
<!--                <a href="personal-info.html">-->
<!--                    <i class="icon-cog"></i>-->
<!--                    <span>我的信息</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            -->
<!--        </ul>-->
<!--    </div>-->
    <!-- end sidebar -->
    

	<!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>订单列表</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="Type a user's name..." />
                        
                        <div class="ui-dropdown">
                            <button class="btn">Search</button>
                        </div>
    
                        <a href="new-user.html" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            发布新商品
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    订单编号
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>收货人
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>订单状态
                                </th>                                
                                <th class="span1 sortable">
                                    <span class="line"></span>支付状态
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>配送状态
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>支付方式
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>订单金额
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>下单时间
                                </th>                                                                                                
                                <th class="span1 sortable align-right">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($orderList as $v):?>
                        <tr class="first">
                            <td>

                                <a href="<?= Url::to(['order/ship-show','orderid'=>$v['orderid']]);?>" class="name"><?=$v['orderno'];?></a>
                                <span class="subtext"><?=$v['postscript'];?></span>
                            </td>
                            <td>
                                <?=$v['consignee'];?>
                            </td>
                            <td>
                                <span class="<?= Order::$orderStyle[$v['status']];?>"><?= Order::$orderStatus[$v['status']];?></span>
                            </td>
                            <td>
                                <?= ($v['paystatus'])?'已支付':'未支付';?>
                            </td>
                            <td>
                                <?= ($v['shipstatus'])?"<span class='label label-success'>已发货</span>":"<span class='label label-warning'>未发货</span>";?>


                            </td>
                            <td>
                                <?=$v['paytype'];?>
                            </td>
                            <td>
                                <?=$v['orderamount'];?>￥
                            </td>
                            <td>
                                <?= date('Y-m-d H:i:s',$v['createtime']);?>
                            </td>
                            <td class="align-right">
                                <a href="<?= Url::to(['order/ship-show','orderid'=>$v['orderid']]);?>">查看</a> |
                                <a href="#">回收站</a>
                            </td>
                        </tr>
                        <!-- row -->
                        <?php endforeach;?>



                        </tbody>
                    </table>
                </div>
                <div class="pagination pull-right">
                    <ul>
                      <?= LinkPager::widget([
                          'pagination'=>$page,
                      ])?>
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