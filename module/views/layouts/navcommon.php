<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/21
 * Time: 10:08
 */
use yii\helpers\Url;
?>


<!-- navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="brand" href="index.html" style="font-weight:700;font-family:Microsoft Yahei">必应商城 - 后台管理</a>

        <ul class="nav pull-right">
            <li class="hidden-phone">
                <input class="search" type="text" />
            </li>
            <li class="notification-dropdown hidden-phone">
                <a href="#" class="trigger">
                    <i class="icon-warning-sign"></i>
                    <span class="count">6</span>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                        <div class="notifications">
                            <h3>你有 6 个新通知</h3>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> 新用户注册
                                <span class="time"><i class="icon-time"></i> 13 分钟前.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> 新用户注册
                                <span class="time"><i class="icon-time"></i> 18 分钟前.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> 新用户注册
                                <span class="time"><i class="icon-time"></i> 49 分钟前.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-download-alt"></i> 新订单
                                <span class="time"><i class="icon-time"></i> 1 天前.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">查看所有通知</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="notification-dropdown hidden-phone">
                <a href="#" class="trigger">
                    <i class="icon-envelope-alt"></i>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                        <div class="messages">
                            <a href="#" class="item">
                                <img src="admin/img/contact-img.png" class="display" />
                                <div class="name">Alejandra Galván</div>
                                <div class="msg">
                                    There are many variations of available, but the majority have suffered alterations.
                                </div>
                                <span class="time"><i class="icon-time"></i> 13 min.</span>
                            </a>
                            <a href="#" class="item">
                                <img src="admin/img/contact-img2.png" class="display" />
                                <div class="name">Alejandra Galván</div>
                                <div class="msg">
                                    There are many variations of available, have suffered alterations.
                                </div>
                                <span class="time"><i class="icon-time"></i> 26 min.</span>
                            </a>
                            <a href="#" class="item last">
                                <img src="admin/img/contact-img.png" class="display" />
                                <div class="name">Alejandra Galván</div>
                                <div class="msg">
                                    There are many variations of available, but the majority have suffered alterations.
                                </div>
                                <span class="time"><i class="icon-time"></i> 48 min.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">View all messages</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                    账户管理
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">个人信息管理</a></li>
                    <li><a href="<?= Url::to(['admin/update-pwd']);?>">修改密码</a></li>
                    <li><a href="#">订单管理</a></li>
                </ul>
            </li>
            <li class="settings hidden-phone">
                <a href="personal-info.html" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings hidden-phone">
                <a href="<?= Url::to(['login/logout']);?>" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- end navbar -->

<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li class="active">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="<?= Url::to(['index/index']);?>">
                <i class="icon-home"></i>
                <span>后台首页</span>
            </a>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-user"></i>
                <span>管理员管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?= Url::to(['admin/show']);?>">管理员列表</a></li>
                <li><a href="<?= Url::to(['admin/insert']);?>">管理员添加</a></li>

            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-group"></i>
                <span>会员管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?= Url::to(['user/show']);?>">会员列表</a></li>
                <li><a href="<?= Url::to(['user/insert']);?>">会员添加</a></li>

            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-shopping-cart"></i>
                <span>商品管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?= Url::to(['shop/show']);?>">分类列表</a></li>
                <li><a href="<?= Url::to(['shop/insert']);?>">分类添加</a></li>
                <li><a href="<?= Url::to(['brand/insert']);?>">品牌添加</a></li>
                <li><a href="<?= Url::to(['brand/show']);?>">品牌列表</a></li>
                <li><a href="<?= Url::to(['goods/list']);?>">商品列表</a></li>
                <li><a href="<?= Url::to(['goods/add']);?>">商品添加</a></li>
                <li><a href="<?= Url::to(['goods/show']);?>">商品回收站</a></li>

            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-th-list"></i>
                <span>订单管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?= Url::to(['order/ship-list']);?>">订单列表</a></li>

            </ul>
        </li>
        <li>
            <a href="chart-showcase.html">
                <i class="icon-signal"></i>
                <span>统计</span>
            </a>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-group"></i>
                <span>用户管理</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="user-list.html">用户列表</a></li>
                <li><a href="new-user.html">加入新用户</a></li>
                <li><a href="user-profile.html">用户信息</a></li>
            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="icon-edit"></i>
                <span>表单</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="form-showcase.html">基本表单</a></li>
                <li><a href="form-wizard.html">步骤表单</a></li>
            </ul>
        </li>
        <li>
            <a href="gallery.html">
                <i class="icon-picture"></i>
                <span>相册管理</span>
            </a>
        </li>
        <li>
            <a href="calendar.html">
                <i class="icon-calendar-empty"></i>
                <span>日历事件管理</span>
            </a>
        </li>
        <li>
            <a href="tables.html">
                <i class="icon-th-large"></i>
                <span>表格</span>
            </a>
        </li>

        <li>
            <a href="personal-info.html">
                <i class="icon-cog"></i>
                <span>我的信息</span>
            </a>
        </li>

    </ul>
</div>
<!-- end sidebar -->


<?= $content;?>
