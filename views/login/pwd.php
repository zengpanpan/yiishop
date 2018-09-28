<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 18:57
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
    <div class="login">
        <div class="log_img"><img src="images/l_img.png" width="611" height="425" /></div>

        <div class="log_c" id="common">
            <?php $table=ActiveForm::begin([
                'fieldConfig'=>
                    ['template'=>"<tr height=\"70\"><td ><font color=\"#ff4e00\">*</font>{label}</td><td>{input}<font color=\"#ff4e00\">{error}</font></td></tr>"]
            ]);?>
                <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr height="50" valign="top">
                        <td width="55">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:24px;"><a class="one" >找回密码</a></span>
                            <span class="fr">还没有商城账号，<a href="<?= Url::to(['login/register']);?>" style="color:#ff4e00;">立即注册</a></span>
                        </td>
                    </tr>
                    <?=$table->field($user,'user_pwd')->passwordInput(['class'=>'l_pwd'])->label('新密码');?>
                    <?=$table->field($user,'user_rpwd')->passwordInput(['class'=>'l_pwd'])->label('确认密码');?>


                    <tr height="60">
                        <td>&nbsp;</td>
                        <td><input type="submit"  value="确认修改" class="log_btn" /></td>
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
        //普通登陆
      $(".one").click(function(){
        $("#common").show();
          $("#phone").hide();
          $("#find").hide();
      });
        //短信登陆
        $(".two").click(function(){
            $("#common").hide();
            $("#find").hide();
            $("#phone").show();
        });

        /*
        *
        * 短信动态密码发送
        * */
        $(".button").click(function(){
            var phone=$("input[name='phone']").val();
            if(phone=='')
            {
                $(".phone").html("<font color='red'>手机号不能为空!</font>");
                return false;
            }

            if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(phone))
            {
                $(".phone").html("<font color='red'>手机号不合法!</font>");
                return false;
            }
            $(".phone").html('');
            var url="<?=Url::to(['login/phone']);?>";
            $.get(url,{phone:phone},function(result){

                if(result.code==0)
                {
                    $(".phone").html("<font color='red'>该手机号没有被注册!</font>");
                    return false;
                }
                else if(result.code==1)
                {
                    $(".phone").html("<font color='red'>短信发送失败,请重发!</font>");
                    return false;
                }
            },'json');
        });
        /**
         *手机动态密码登陆
         *
         */
        $("input[name='sub']").click(function(){
            var phone=$("input[name='phone']").val();
            var msm=$("input[name='pwds']").val();
            var url="<?=Url::to(['login/checklogin']);?>";
            if(phone=='')
            {
                $(".phone").html("<font color='red'>手机号不能为空!</font>");
                return false;
            }
            if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(phone))
            {
                $(".phone").html("<font color='red'>手机号不合法!</font>");
                return false;
            }
            $(".phone").html('');
            if(msm=='')
            {
                $(".pwds").html("<font color='red'>密码不能为空!</font>");
                return false;
            }
            $(".pwds").html('');
            $.get(url,{phone:phone,msm:msm},function(result){
                if(result['code']==1)//登陆成功
                {
                    location.href="<?=Url::to(['index/index']); ?>";
                }
                else if(result['code']==0)//号码或密码有误
                {

                    $(".pwds").html("<font color='red'>"+result['msg']+"</font>");
                }
                else if(result['code']==2)//密码找回
                {
                    var rpassword=$("#rpassword").html();
                    $("#password").html(rpassword);
                }

            },'json');

        });





         /**
         * 普通登陆
         */
        $("input[name='submit']").click(function(result){
            var name=$("input[name='name']").val();
            var pwd=$("input[name='pwd']").val();
            if(name=='')
            {
                $(".name").html("<font color='red'>用户名不能为空!</font>");
                return false;
            }
            if(pwd=='')
            {
                $(".name").html('');
                $(".pwd").html("<font color='red'>密码不能为空!</font>");
                return false;
            }
            $(".pwd").html('');
            var url="<?=Url::to(['member/ajax-login']);?>";
            $.get(url,{name:name,pwd:pwd},function(result){
                if(result['code']==1)
                {
                   location.href="<?=Url::to(['index/index']); ?>";
                }
                else if(result['code']==0)
                {

                    $(".pwd").html("<font color='red'>"+result['msg']+"</font>");
                }
            },'json');
        });


    });
</script>


