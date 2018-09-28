<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <script type="text/javascript" src="js/jquery-1.11.1.min_044d0927.js"></script>

    <?= $this->render('/common/public');?>

    <script type="text/javascript" src="js/n_nav.js"></script>

    <script type="text/javascript" src="js/select.js"></script>

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
        <img src="images/img2.jpg" />
    </div>

    <!--Begin 第二步：确认订单信息 Begin -->

    <div class="content mar_20">
        <?php $form=ActiveForm::begin();?>
        <div class="two_bg">
            <div class="two_t">
                <span class="fr"><a href="#">修改</a></span>商品列表
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="car_th" width="550">商品名称</td>
                    <td class="car_th" width="140">单价</td>
                    <td class="car_th" width="150">购买数量</td>
                    <td class="car_th" width="130">小计</td>
<!--                    <td class="car_th" width="140">返还积分</td>-->
                </tr>
                <?php foreach($goodsList as $key=>$v):?>
<!--                    隔行变色-->
                <tr <?= ($key%2)? 'class="car_tr"' : '' ;?>>
                    <td>
                        <div class="c_s_img"><img src="<?=$v['goods_img'];?>" width="73" height="73" /></div>
                        <?=$v['goods_name'];?>
                    </td>
                    <td align="center"><?=$v['goods_price'];?></td>
                    <td align="center"><?=$v['buy_num'];?></td>
                    <td align="center" style="color:#ff4e00;">￥<?=$v['total'];?></td>
<!--                    <td align="center">26R</td>-->
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="5" align="right" style="font-family:'Microsoft YaHei';">
                        <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;">￥<?=$total?></b></span>

                    </td>
                </tr>
            </table>

            <div class="two_t">
                <span class="fr"><a href="#">修改</a></span>收货人信息
            </div>
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="p_td" width="160">收货名称</td>
                    <td width="395"><?=$Address['consignee'];?></td>
                    <td class="p_td" width="160">电子邮件</td>
                    <td width="395"><?=$Address['email'];?></td>
                </tr>
                <tr>
                    <td class="p_td">详细信息</td>
                    <td><?=$Address['fullarea'];?><?=$Address['address'];?></td>
                    <td class="p_td">邮政编码</td>
                    <td><?=$Address['zipcode'];?></td>
                </tr>
                <tr>
                    <td class="p_td">手机</td>
                    <td><?=$Address['mobile'];?></td>
                    <td class="p_td">电话</td>
                    <td></td>
                </tr>

            </table>


            <div class="two_t">
                配送方式
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="car_th" width="80"></td>
                    <td class="car_th" width="200">名称</td>
                    <td class="car_th" width="370">订购描述</td>
                    <td class="car_th" width="150">费用</td>
<!--                    <td class="car_th" width="135">免费额度</td>-->
<!--                    <td class="car_th" width="175">保价费用</td>-->
                </tr>
                <?php foreach($shipWay as $v):?>
                <tr>
                    <td align="center"><input type="radio" name="shipid" class="radio" value="<?=$v['shipid'];?>" <?= ($v['isdefault']) ? 'checked':''?>/></td>
                    <td align="center" style="font-size:14px;"><b><?=$v['shipname'];?></b></td>
                    <td><?=$v['shipdesc'];?></td>
                    <td align="center" id="price"><?=$v['shipprice'];?></td>
<!--                    <td align="center">￥0.00</td>-->
<!--                    <td align="center">不支持保价</td>-->
                </tr>
                <?php endforeach;?>

                <tr>
                    <td colspan="6">
                        <span class="fr"><label class="r_rad"><input type="checkbox" name="baojia" /></label><label class="r_txt">配送是否需要保价</label></span>
                    </td>
                </tr>
            </table>

            <div class="two_t">
                支付方式
            </div>
            <ul class="pay">
                <?php foreach($payment as $v):?>

                <li name="li" data-code="<?=$v['paycode'];?>"><span class="payname"><?=$v['payname'];?></span><div class="ch_img"></div></li>
                <?php endforeach;?>
                <input type="hidden" name="paytype" >
            </ul>

<!--            <div class="two_t">-->
<!--                商品包装-->
<!--            </div>-->
<!--            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">-->
<!--                <tr>-->
<!--                    <td class="car_th" width="80"></td>-->
<!--                    <td class="car_th" width="490">名称</td>-->
<!--                    <td class="car_th" width="180">费用</td>-->
<!--                    <td class="car_th" width="180">免费额度</td>-->
<!--                    <td class="car_th" width="180">图片</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td align="center"><input type="checkbox" name="pack" checked="checked" /></td>-->
<!--                    <td><b style="font-size:14px;">不要包装</b></td>-->
<!--                    <td align="center">￥15.00</td>-->
<!--                    <td align="center">￥0.00</td>-->
<!--                    <td align="center"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td align="center"><input type="checkbox" name="pack" /></td>-->
<!--                    <td><b style="font-size:14px;">精品包装</b></td>-->
<!--                    <td align="center">￥15.00</td>-->
<!--                    <td align="center">￥0.00</td>-->
<!--                    <td align="center"><a href="#" style="color:#ff4e00;">查看</a></td>-->
<!--                </tr>-->
<!--            </table>-->
<!---->
<!--            <div class="two_t">-->
<!--                祝福贺卡-->
<!--            </div>-->
<!--            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">-->
<!--                <tr>-->
<!--                    <td class="car_th" width="80"></td>-->
<!--                    <td class="car_th" width="490">名称</td>-->
<!--                    <td class="car_th" width="180">费用</td>-->
<!--                    <td class="car_th" width="180">免费额度</td>-->
<!--                    <td class="car_th" width="180">图片</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td align="center"><input type="checkbox" name="wish" checked="checked" /></td>-->
<!--                    <td><b style="font-size:14px;">不要贺卡</b></td>-->
<!--                    <td align="center">￥15.00</td>-->
<!--                    <td align="center">￥0.00</td>-->
<!--                    <td align="center"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td align="center" style="border-bottom:0; padding-bottom:0;"><input type="checkbox" name="wish" /></td>-->
<!--                    <td style="border-bottom:0; padding-bottom:0;"><b style="font-size:14px;">祝福贺卡</b></td>-->
<!--                    <td align="center" style="border-bottom:0; padding-bottom:0;">￥15.00</td>-->
<!--                    <td align="center" style="border-bottom:0; padding-bottom:0;">￥0.00</td>-->
<!--                    <td align="center" style="border-bottom:0; padding-bottom:0;"><a href="#" style="color:#ff4e00;">查看</a></td>-->
<!--                </tr>-->
<!--                <tr valign="top">-->
<!--                    <td align="center"></td>-->
<!--                    <td colspan="4">-->
<!--                        <span class="fl"><b style="font-size:14px;">祝福语：</b></span>-->
<!--                        <span class="fl"><textarea class="add_txt" style="width:860px; height:50px;"></textarea></span>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->

            <div class="two_t">
                其他信息
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="145" align="right" style="padding-right:0;"><b style="font-size:14px;">使用红包：</b></td>
                    <td>
                        <span class="fl" style="margin-left:50px; margin-right:10px;">选择已有红包</span>
                        <select class="jj" name="">
                            <option value="0" selected="selected">请选择</option>
                            <option value="1">50元</option>
                            <option value="2">30元</option>
                            <option value="3">20元</option>
                            <option value="4">10元</option>
                        </select>
                        <span class="fl" style="margin-left:50px; margin-right:10px;">或者输入红包序列号</span>
                    <span class="fl"><input type="text" value="" class="c_ipt" style="width:220px;" />
                    <span class="fr" style="margin-left:10px;"><input type="submit" value="验证红包" class="btn_tj" /></span>
                    </td>
                </tr>
                <tr valign="top">
                    <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b></td>
                    <td style="padding-left:0;"><textarea class="add_txt" name="postscript" style="width:860px; height:50px;"></textarea></td>
                </tr>
<!--                <tr>-->
<!--                    <td align="right" style="padding-right:0;"><b style="font-size:14px;">缺货处理：</b></td>-->
<!--                    <td>-->
<!--                        <label class="r_rad"><input type="checkbox" name="none" checked="checked" /></label><label class="r_txt" style="margin-right:50px;">等待所有商品备齐后再发</label>-->
<!--                        <label class="r_rad"><input type="checkbox" name="none" /></label><label class="r_txt" style="margin-right:50px;">取下订单</label>-->
<!--                        <label class="r_rad"><input type="checkbox" name="none" /></label><label class="r_txt" style="margin-right:50px;">与店主协商</label>-->
<!--                    </td>-->
<!--                </tr>-->
            </table>

            <table border="0" style="width:900px; margin-top:20px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right">

                        商品总价: <font color="#ff4e00">￥<sapn class="s"><?=$total?></sapn></font>  + 配送费用: <font color="#ff4e00">￥<span id="span"><?=$shipPrice;?></span></font>
                    </td>
                </tr>
                <tr height="70">
                    <td align="right">
                        <b style="font-size:14px;">商品总价：<span style="font-size:22px; color:#ff4e00;"><s >￥<?=$total?></s></span></b><br>
                        <b style="font-size:14px;">应付款金额：<span style="font-size:22px; color:#ff4e00;">￥<span class="total"><?=$total+$shipPrice;?></span></span></b>
                    </td>
                </tr>
                <tr height="70">
<!--                    验证错误-->
                    <?= $form->errorSummary($model);?>
                    <td align="right"><?= Html::submitButton('确认订单',['class'=>'btn_tj'])?></td>
                </tr>
            </table>



        </div>

        <?php ActiveForm::end();?>
    </div>
    <!--End 第二步：确认订单信息 End-->


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
         * 实际价格（加上运费）
         */
        $(".radio").click(function(result){
            var shipprice=$(this).parent().siblings("#price").html();
            $("#span").html(shipprice);//快递价
            var total=$(".s").html();//原价
            var count=parseInt(shipprice)+parseInt(total);//加法转化数值型
            $(".total").html(count);//实际价格


        });
        /**
         * 支付方式选中样式
         */
        $("li[name='li']").click(function(){
            $(this).addClass("checked").siblings().removeClass();
            $("input[name='paytype']").val($(this).attr("data-code"));
        });
    });
</script>
</html>
