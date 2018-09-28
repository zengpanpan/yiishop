<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 18:58
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<!--Begin Login Begin-->
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="Index.html"><img src="images/logo.png" /></a></div>
    </div>
    <div class="regist">
        <div class="log_img"><img src="images/l_img.png" width="611" height="425" /></div>
<!--        手机注册-->
        <div class="reg_c" style="display: none" id="phone">
            <?php $table=ActiveForm::begin([
                'fieldConfig'=>
                    ['template'=>"<tr height=\"50\"><td align=\"right\"><font color=\"#ff4e00\">*</font>&nbsp;{label}&nbsp;</td><td>{input}<font color=\"#ff4e00\">{error}</font></td></tr>"]
            ]);?>

            <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                <tr height="50" valign="top">
                    <td width="95">&nbsp;</td>
                    <input type="hidden" name="type" value="1" >
                    <td>
                        <span class="fl" style="font-size:12px;"><a class="one" >普通注册</a></span>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="fr" style="font-size:12px;"><a class="two">手机号注册</a></span><br>
                        <span class="fr">已有商城账号，<a href="<?= Url::to(['login/login']);?>" style="color:#ff4e00;">我要登录</a></span>
                    </td>
                </tr>
                <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;手机号 &nbsp;</td>
                    <td><input type="text" value="" name="user_phone" class="l_tel" /><span class="span"></span></td>
                </tr>

                <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;密码 &nbsp;</td>
                    <td><input type="password" value="" name="user_pwd" class="l_pwd" /></td>
                </tr>
                <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;确认密码 &nbsp;</td>
                    <td><input type="password" value="" name="user_rpwd" class="l_pwd" /></td>
                </tr>
                <tr height="50">
                    <td align="right"> <font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>
                    <td>
                        <input type="text" value="" name="code" class="l_ipt" />
                        <button class="btn_u" type="button">获取验证码</button>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
                    	<label class="r_rad"><input type="checkbox" /></label><label class="r_txt">我已阅读并接受《用户协议》</label>
                    </span>
                    </td>
                </tr>
                <tr height="60">
                    <td>&nbsp;</td>
                    <td><?= Html::submitButton('立即注册',['class'=>'log_btn'])?></td>
                </tr>
            </table>
            <?php ActiveForm::end();?>
            <?= $table->errorSummary($user);?>
        </div>
<!--        普通注册-->
        <div class="reg_c" id="form">
            <?php $table=ActiveForm::begin([
                'fieldConfig'=>
                    ['template'=>"<tr height=\"50\"><td align=\"right\"><font color=\"#ff4e00\">*</font>&nbsp;{label}&nbsp;</td><td>{input}<font color=\"#ff4e00\">{error}</font></td></tr>"]
            ]);?>
                <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                    <tr height="50" valign="top">
                        <td width="95">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:12px;"><a class="one" >普通注册</a></span>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="fr" style="font-size:12px;"><a class="two">手机号注册</a></span><br>
                            <span class="fr">已有商城账号，<a href="<?= Url::to(['login/login']);?>" style="color:#ff4e00;">我要登录</a></span>
                        </td>
                    </tr>

                        <?= $table->field($user,'user_name')->textInput(['class'=>'l_user'])->label('用户名');?>
                        <?= $table->field($user,'user_pwd')->passwordInput(['class'=>'l_pwd'])->label('密码');?>
                        <?= $table->field($user,'user_rpwd')->passwordInput(['class'=>'l_pwd']);?>
                        <?= $table->field($user,'email')->textInput(['class'=>'l_email']);?>
                        <?= $table->field($user,'user_phone')->textInput(['class'=>'l_tel']);?>



<!--                    <tr height="50">-->
<!--                        <td align="right"><font color="#ff4e00">*</font>&nbsp;邮箱 &nbsp;</td>-->
<!--                        <td><input type="text" value="" class="l_email" /></td>-->
<!--                    </tr>-->
<!--                    <tr height="50">-->
<!--                        <td align="right"><font color="#ff4e00">*</font>&nbsp;手机 &nbsp;</td>-->
<!--                        <td><input type="text" value="" class="l_tel" /></td>-->
<!--                    </tr>-->
<!--                    <tr height="50">-->
<!--                        <td align="right">邀请人会员名 &nbsp;</td>-->
<!--                        <td><input type="text" value="" class="l_mem" /></td>-->
<!--                    </tr>-->
<!--                    <tr height="50">-->
<!--                        <td align="right">邀请人ID号 &nbsp;</td>-->
<!--                        <td><input type="text" value="" class="l_num" /></td>-->
<!--                    </tr>-->
<!--                    <tr height="50">-->
<!--                        <td align="right"> <font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>-->
<!--                        <td>-->
<!--                            <input type="text" value="" class="l_ipt" />-->
<!--                            <a href="#" style="font-size:12px; font-family:'宋体';">换一张</a>-->
<!--                        </td>-->
<!--                    </tr>-->
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
                        <?= $table->field($user,'check',['template'=>'{input}{label}<font color="#ff4e00">{error}</font>'])->checkbox()?>
<!--                    	<label class="r_rad"><input type="checkbox" /></label><label class="r_txt">我已阅读并接受《用户协议》</label>-->
                    </span>
                        </td>
                    </tr>
                    <tr height="60">
                        <td>&nbsp;</td>
                        <td><?= Html::submitButton('立即注册',['class'=>'log_btn'])?></td>
                    </tr>
                </table>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>
<!--End Login End-->
<!--Begin Footer Begin-->
<script>
    $(function(){
        //普通注册显示
        $(".one").click(function(){
            $("#form").show();
            $("#phone").hide();
        });
        //手机号注册显示
        $(".two").click(function(){
            $("#form").hide();
            $("#phone").show();
        });
        /**
         * 手机号验证码发送
         */
        $(".btn_u").click(function(){
            var phone=$(".l_tel").val();
            var url="<?=Url::to(['login/codes']);?>";
            $.get(url,{phone:phone},function(result){

                if(result.success==0)
                {

                    $(".span").html("<font color='red'>"+result.msg+"</font>");
                }
                else
                {

                    $(".span").html('');
                }
            },'json');
            $(this).attr('disabled',true);
            $(this).css('background','gray');
            var num=60;
            var _this=$(this);
             var timer=setInterval(function(){
                 if(num>0)
                 {
                     num-=1;
                     _this.html(num+'s 后重新发送');
                 }
                 else
                 {
                     _this.html('获取验证码');
                     _this.attr('disabled',false);
                     _this.css('background','#ff4e00');
                     clearInterval(timer);


                 }

            },1000)

        });

    });
</script>


