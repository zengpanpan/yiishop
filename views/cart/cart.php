<?php

use yii\helpers\Url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="js/jquery-1.11.1.min_044d0927.js"></script>


    <?= $this->render('/common/public');?>


    <script type="text/javascript" src="js/n_nav.js"></script>

    <script type="text/javascript" src="js/num.js">
        var jq = jQuery.noConflict();
    </script>

    <script type="text/javascript" src="js/shade.js"></script>

    <title>尤洪</title>
</head>
<body>
<!--Begin Header Begin-->
<?= $this->render('/common/top');?>
<?= $this->render('/common/menu');?>
<!--End Menu End-->
<div class="i_bg">
    <div class="content mar_20">
        <img src="images/img1.jpg" />
    </div>

    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
        <table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
            <tr>
                <td class="car_th" width="490">商品名称</td>
<!--                <td class="car_th" width="140">属性</td>-->
                <td class="car_th" width="150">购买数量</td>
                <td class="car_th" width="130">小计</td>
<!--                <td class="car_th" width="140">返还积分</td>-->
                <td class="car_th" width="150">操作</td>
            </tr>
<!--            购物车为空时提醒-->
            <?php if($cartList==null):?>
            <tr>
                <td align="center" colspan="4"><h1><font color="green">购物车为空,亲 <a href="<?= Url::to(['index/index']);?>"><font color="red">点我去购物</font></a></font></h1></td>
            </tr>
            <?php endif;?>
            <?php foreach($cartList as $v):?>
            <tr>
                <td>
                    <div class="c_s_img"><img src="<?= $v['goods_img'];?>" width="73" height="73" /></div>
                   <?= $v['goods_name'];?>
                </td>
<!--                <td align="center">颜色：灰色</td>-->
                <td align="center">
                    <div class="c_num">
                        <input type="button" value="" onclick="jianUpdate1(jq(this));" class="car_btn_1" />
                        <input type="text" value="<?= $v['buy_num'];?>" name="" class="car_ipt" />
                        <input type="button" value="" onclick="addUpdate1(jq(this));" class="car_btn_2" />
                    </div>
                </td>
                <td align="center" style="color:#ff4e00;">￥<?=$v['total'];?></td>
<!--                <td align="center">26R</td>-->
                <td align="center"><a onclick="ShowDiv('MyDiv','fade')">删除</a>&nbsp; &nbsp;<a href="#">加入收藏</a></td>
                <input type="hidden"value="<?=$v['cart_id'];?>" id="hidden">
            </tr>
            <?php endforeach;?>

            <tr height="70">
                <td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
                    <label class="r_rad"><input type="checkbox" name="clear" checked="checked" /></label><label class="r_txt">清空购物车</label>
                    <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;">￥<?=$prices;?></b></span>
                </td>
            </tr>
            <tr valign="top" height="150">
                <td colspan="6" align="right">
                    <a href="javascript:history.back(-1);"><img src="images/buy1.gif" /></a>&nbsp; &nbsp; <a href="<?= Url::to(['order/confirm']);?>"><img src="images/buy2.gif" /></a>
                </td>
            </tr>
        </table>

    </div>
    <!--End 第一步：查看购物车 End-->


    <!--Begin 弹出层-删除商品 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="font-size:16px;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td>您确定要把该商品移除购物车吗？</td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td><a href="javascript:;" id="del" class="b_sure">确定</a><a onclick="CloseDiv('MyDiv','fade')" class="b_buy">取消</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-删除商品 End-->


    <!--Begin Footer Begin -->
    <?= $this->render('/common/footer');?>
    <!--End Footer End -->
</div>

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
<script>
    $(function(){
        /**
         * 购物车删除
         */
        $("#del").click(function(result){
            var cart_id=$("#hidden").val();
            alert(cart_id);
        });
    });
</script>
</html>
