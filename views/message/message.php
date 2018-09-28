<?php
$message=\Yii::$app->session->getFlash('msg');
 $msg=isset($message) ? $message : '您的操作异常,走丢了！' ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


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
<!--        <img src="images/img3.jpg" />-->
    </div>

    <!--Begin 第三步：提交订单 Begin -->
    <div class="content mar_20">

        <!--Begin 银行卡支付 Begin -->
<!--        <div class="warning">-->
<!--            <table border="0" style="width:1000px; text-align:center;" cellspacing="0" cellpadding="0">-->
<!--                <tr height="35">-->
<!--                    <td style="font-size:18px;">-->
<!--                        感谢您在本店购物！您的订单已提交成功，请记住您的订单号: <font color="#ff4e00">--><?//=$orderno;?><!--</font>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td style="font-size:14px; font-family:'宋体'; padding:10px 0 20px 0; border-bottom:1px solid #b6b6b6;">-->
<!--                        您选定的配送方式为: <font color="#ff4e00">--><?//=$paytype?><!--</font>； &nbsp; &nbsp;您选定的支付方式为: <font color="#ff4e00">--><?//=$shipid?><!--</font>； &nbsp; &nbsp;您的应付款金额为: <font color="#ff4e00">￥--><?//=$orderamount?><!--</font>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td style="padding:20px 0 30px 0; font-family:'宋体';">-->
<!--                        银行名称 收款人信息：全称 ××× ；帐号或地址 ××× ；开户行 ×××。 <br />-->
<!--                        注意事项：办理电汇时，请在电汇单“汇款用途”一栏处注明您的订单号。-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>-->
<!--                        <a href="#">首页</a> &nbsp; &nbsp; <a href="#">用户中心</a>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
        <!--Begin 银行卡支付 Begin -->

        <!--Begin 支付宝支付 Begin -->
<!--        <div class="warning">-->
<!--            <table border="0" style="width:1000px; text-align:center;" cellspacing="0" cellpadding="0">-->
<!--                <tr height="35">-->
<!--                    <td style="font-size:18px;">-->
<!--                        感谢您在本店购物！您的订单已提交成功，请记住您的订单号: <font color="#ff4e00">--><?//=$orderno;?><!--</font>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td style="font-size:14px; font-family:'宋体'; padding:10px 0 20px 0; border-bottom:1px solid #b6b6b6;">-->
<!--                        您选定的配送方式为: <font color="#ff4e00">--><?//=$paytype?><!--</font>； &nbsp; &nbsp;您选定的支付方式为: <font color="#ff4e00">--><?//=$shipid?><!--</font>； &nbsp; &nbsp;您的应付款金额为: <font color="#ff4e00">￥--><?//=$orderamount?><!--</font>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td style="padding:20px 0 30px 0; font-family:'宋体';">-->
<!--                        支付宝网站(www.alipay.com) 是国内先进的网上支付平台。<br />-->
<!--                        支付宝收款接口：在线即可开通，零预付，免年费，单笔阶梯费率，无流量限制。<br />-->
<!--                        <a href="#" style="color:#ff4e00;">立即在线申请</a>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>-->
<!--                        <div class="btn_u" style="margin:0 auto; padding:0 20px; width:120px;"><a href="#">立即使用支付宝支付</a></div>-->
<!--                        <a href="#">首页</a> &nbsp; &nbsp; <a href="#">用户中心</a>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
        <!--Begin 支付宝支付 Begin -->

        <!--Begin 余额不足 Begin -->
        <div class="warning">
            <table border="0" style="width:1000px; text-align:center;" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <p style="font-size:22px;">提示 !</p>
                        <b style="color:#ff4e00; font-size:16px; font-family:'宋体';"><?=$msg;?></b>
                        <div class="backs"><a href="javascript:history.back(-1);">返回上一页</a></div>
                    </td>
                </tr>
            </table>
        </div>
        <!--Begin 余额不足 Begin -->


    </div>
    <!--End 第三步：提交订单 End-->

    <!--Begin Footer Begin -->
    <?= $this->render('/common/footer');?>
    <!--End Footer End -->

</div>

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>