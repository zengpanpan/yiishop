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
<!--        普通登陆-->
        <div class="log_c" id="common">
                <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr height="50" valign="top">
                        <td width="55">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:12px;"><a class="one" >普通登录</a></span>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="fr" style="font-size:12px;"><a class="two">手机动态密码登录</a></span>
                            <span class="fr">还没有商城账号，<a href="<?= Url::to(['login/register']);?>" style="color:#ff4e00;">立即注册</a></span>
                        </td>
                    </tr>
                    <div id="tr">
                    <tr height="70">
                        <td>用户名</td>
                        <td><input type="text" name="name" placeholder="用户名" class="l_user" /><span class="name"></span></td>
                    </tr>
                    <tr height="70">
                        <td>密&nbsp; &nbsp; 码</td>
                        <td><input type="password" name="pwd" placeholder="密码" value="" class="l_pwd" /><span class="pwd"></span></td>

                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
                        <span id="error"></span>
                    	<label class="r_rad"><input type="checkbox" /></label><label class="r_txt">请保存我这次的登录信息</label>
                    </span>
                            <span class="fr"><a href="<?=Url::to(['login/email']);?>" class="find" style="color:#ff4e00;">邮箱找回密码</a></span>
                        </td>
                    </tr>
                    <tr height="60">
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="登录" class="log_btn" /></td>
                    </tr>
                </table>

        </div>
<!--        短信登陆-->
        <div class="log_c" id="phone" style="display:none">
            <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                <tr height="50" valign="top">
                    <td width="55">&nbsp;</td>
                    <td>
                        <span class="fl" style="font-size:12px;"><a class="one">普通登录</a></span>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="fr" style="font-size:12px;"><a class="two">手机动态密码登录</a></span>
                        <span class="fr">还没有商城账号，<a href="<?= Url::to(['login/register']);?>" style="color:#ff4e00;">立即注册</a></span>
                    </td>
                </tr>

                    <tr height="70">
                        <td>手机号</td>
                        <td><input type="text" name="phone" value="" placeholder="请输入注册手机号" class="l_tel" id="users-user_phone" /><span class="phone"></span></td>
                    </tr>
                    <tr height="70">
                        <td>密&nbsp; &nbsp; 码</td>
                        <td><input type="password" name="pwds" value="" placeholder="动态密码" class="l_pwd" style="width:58px " /><button style="width:120px;height:36px;cursor:pointer;" class="button" >发送动态密码</button><span class="pwds"></span></td>

                    </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td style="font-size:12px; padding-top:20px;">
                	<span style="font-family:'宋体';" class="fl">
                        <span id="error"></span>
                    	<label class="r_rad"><input type="checkbox" /></label><label class="r_txt">请保存我这次的登录信息</label>
                    </span>
                        <span class="fr"><a href="<?=Url::to(['login/email']);?>" class="find" style="color:#ff4e00;">邮箱找回密码</a></span>
                    </td>
                </tr>
                <tr height="60">
                    <td>&nbsp;</td>
                    <td><input type="submit" name="sub" value="登录" class="log_btn" /></td>
                </tr>
            </table>
        </div>
<!--        短信找回密码-->
        <div class="log_c" id="find" style="display:none">
            <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                <tr height="50" valign="top">
                    <td width="55">&nbsp;</td>
                    <td>
                        <span class="fl" style="font-size:12px;"><a class="one">普通登录</a></span>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="fr" style="font-size:12px;"><a class="two">手机动态密码登录</a></span>
                        <span class="fr">还没有商城账号，<a href="<?= Url::to(['login/register']);?>" style="color:#ff4e00;">立即注册</a></span>
                    </td>
                </tr>
                <div class="password">
                <tr height="70">
                    <td>用户名</td>
                    <td><input type="text" name="user" value="" placeholder="请输入用户名号" class="l_user" id="users-user_phone" /><span class="email"></span></td>
                </tr>
                </div>

                <tr height="60">
                    <td>&nbsp;</td>
                    <td><input type="submit" name="email" value="确定" class="log_btn" /></td>
                </tr>
            </table>
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


