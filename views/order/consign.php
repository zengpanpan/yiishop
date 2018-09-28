<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii\helpers\Url;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <div class="two_bg">


            <div class="two_t">
                <span class="fr"><a href="#">修改</a></span>收货人信息
            </div>
            <?php $from=ActiveForm::begin();?>
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="p_td" width="160">收货人</td>
                    <td width="395"><input type="text" name="consignee"></td>
                    <td class="p_td" width="160">地区</td>
                    <td width="395">

                        <select name="country" id="">
                            <option value="" id="country">请选择...</option>
                            <?php foreach($country as $v):?>
                                <option value="<?=$v['region_id'];?>"><?=$v['region_name'];?></option>
                            <?php endforeach;?>

                        </select>
                        <select name="province" id="">
                            <option value="">请选择...</option>

                            <option value="" id="province">请选择...</option>
                        </select>
                        <select name="city" id="">
                            <option value="" id="city">请选择...</option>

                        </select>
                        <select name="district" id="">
                            <option value="" id="district">请选择...</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="p_td">详细信息</td>
                    <td><input type="text" name="address"></td>
                    <td class="p_td">邮政编码</td>
                    <td><input type="text" name="zipcode"></td>
                </tr>
                <tr>
                    <td class="p_td">电话</td>
                    <td><input type="text" name="mobile"></td>
                    <td class="p_td">电子邮件</td>
                    <td><input type="text" name="email"></td>
                </tr>
<!--                <tr>-->
<!--                    <td class="p_td">电子邮件</td>-->
<!--                    <td></td>-->
<!--                    <td class="p_td">最佳送货时间</td>-->
<!--                    <td></td>-->
<!--                </tr>-->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= Html::submitButton('保存',['class'=>'btn_tj'])?></td>
                </tr>
            </table>
            <?= $from->errorSummary($model);?>
<!--            错误提示-->
            <?php if(isset($error)):?>
            <!--Begin 错误提示开始 Begin -->
            <div class="warning">
                <table border="0" style="width:1000px; text-align:center;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <p style="font-size:22px;">提示 !</p>
                            <b style="color:#ff4e00; font-size:16px; font-family:'宋体';"><?= $from->errorSummary($model);?></b>
                        </td>
                    </tr>
                </table>
            </div>
            <!--Begin 错误提示结束 Begin -->
            <?php endif;?>
            <?php ActiveForm::end();?>



        </div>
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
        //省区找市区
        $('select[name="country"]').change(function()
        {

            var url="<?= Url::to(['order/get-region']);?>";
            var region_id=$(this).val();
            $.get(url,{region_id:region_id},function(result){

                $("#province").siblings().remove();
                $('select[name="province"]').append(result.msg);

            });
        });

        //省区找市区
        $('select[name="province"]').change(function()
        {

            var url="<?= Url::to(['order/get-region']);?>";
            var region_id=$(this).val();
            $.get(url,{region_id:region_id},function(result){

                $("#city").siblings().remove();
                $('select[name="city"]').append(result.msg);

            });
        });
        //市区找县区
        $('select[name="city"]').change(function()
        {

            var url="<?= Url::to(['order/get-region']);?>";
            var region_id=$(this).val();
            $.get(url,{region_id:region_id},function(result){

                $("#district").siblings().remove();
                $('select[name="district"]').append(result.msg);

            });
        });


    });
</script>
</html>
