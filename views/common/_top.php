<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/11
 * Time: 16:11
 */
use yii\helpers\Url;
$user=Yii::$app->session->get('user');
?>
<!--公共头部-->
<div class="soubg">
    <div class="sou">
        <!--Begin 所在收货地区 Begin-->
    	<span class="s_city_b">
        	<span class="fl">送货至：</span>
            <span class="s_city">
            	<span>四川</span>
                <div class="s_city_bg">
                    <div class="s_city_t"></div>
                    <div class="s_city_c">
                        <h2>请选择所在的收货地区</h2>
                        <table border="0" class="c_tab" style="width:235px; margin-top:10px;" cellspacing="0" cellpadding="0">
                            <tr>
                                <th>A</th>
                                <td class="c_h"><span>安徽</span><span>澳门</span></td>
                            </tr>
                            <tr>
                                <th>B</th>
                                <td class="c_h"><span>北京</span></td>
                            </tr>
                            <tr>
                                <th>C</th>
                                <td class="c_h"><span>重庆</span></td>
                            </tr>
                            <tr>
                                <th>F</th>
                                <td class="c_h"><span>福建</span></td>
                            </tr>
                            <tr>
                                <th>G</th>
                                <td class="c_h"><span>广东</span><span>广西</span><span>贵州</span><span>甘肃</span></td>
                            </tr>
                            <tr>
                                <th>H</th>
                                <td class="c_h"><span>河北</span><span>河南</span><span>黑龙江</span><span>海南</span><span>湖北</span><span>湖南</span></td>
                            </tr>
                            <tr>
                                <th>J</th>
                                <td class="c_h"><span>江苏</span><span>吉林</span><span>江西</span></td>
                            </tr>
                            <tr>
                                <th>L</th>
                                <td class="c_h"><span>辽宁</span></td>
                            </tr>
                            <tr>
                                <th>N</th>
                                <td class="c_h"><span>内蒙古</span><span>宁夏</span></td>
                            </tr>
                            <tr>
                                <th>Q</th>
                                <td class="c_h"><span>青海</span></td>
                            </tr>
                            <tr>
                                <th>S</th>
                                <td class="c_h"><span>上海</span><span>山东</span><span>山西</span><span class="c_check">四川</span><span>陕西</span></td>
                            </tr>
                            <tr>
                                <th>T</th>
                                <td class="c_h"><span>台湾</span><span>天津</span></td>
                            </tr>
                            <tr>
                                <th>X</th>
                                <td class="c_h"><span>西藏</span><span>香港</span><span>新疆</span></td>
                            </tr>
                            <tr>
                                <th>Y</th>
                                <td class="c_h"><span>云南</span></td>
                            </tr>
                            <tr>
                                <th>Z</th>
                                <td class="c_h"><span>浙江</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </span>
        </span>
        <!--End 所在收货地区 End-->
        <span class="fr">
            <?php if(isset($user)):?>
                <span class="fl">你好[<a href="<?= Url::to(['member/member']);?>"><?= $user['user_name'];?></a>]&nbsp;&nbsp;欢迎登录&nbsp; <a href="<?= Url::to(['member/order']);?>">我的订单</a>&nbsp;|</span>

            <?php else: ?>
                <span class="fl">你好，请<a href="<?= Url::to(['login/login']);?>">登录</a>&nbsp; <a href="<?= Url::to(['login/register']);?>" style="color:#ff4e00;">免费注册</a>&nbsp;|</span>
            <?php endif;?>
            <span class="ss">
            	<div class="ss_list">
                    <a href="#">收藏夹</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">我的收藏夹</a></li>
                                <li><a href="#">我的收藏夹</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ss_list">
                    <a href="#">客户服务</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ss_list">
                    <a href="#">网站导航</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">网站导航</a></li>
                                <li><a href="#">网站导航</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="images/s_tel.png" align="absmiddle" /></a></span>
        </span>
    </div>
</div>
