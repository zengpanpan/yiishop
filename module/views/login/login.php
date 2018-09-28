<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/20
 * Time: 22:55
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>必应商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="admin/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="admin/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="admin/css/lib/font-awesome.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="admin/css/compiled/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>


<div class="row-fluid login-wrapper">
    <a class="brand" href="index.html"></a>
    <?php $form=ActiveForm::begin();?>
    <div class="span4 box">
        <div class="content-wrap">
            <h8><?= $this->render('/common/message');?></h8>

            <h6>电子商城 - 后台管理</h6>
            <?= $form->field($model,'admin_name')->textInput(['class'=>'span12','placeholder'=>'管理员账号'])->label('');?>
            <?= $form->field($model,'admin_pwd')->passwordInput(['class'=>'span12','placeholder'=>'管理员密码'])->label('');?>
            <a href="<?=Url::to(['login/find-pwd']);?>" class="forgot">忘记密码?</a>
            <div class="remember">
                <?= $form->field($model,'remember')->checkbox(['class'=>'remember-me'])?>

<!--                <label for="remember-me">记住我</label>-->
            </div>
            <?= Html::submitButton('登陆',['class'=>'btn-glow primary login'])?>
        </div>
    </div>
    <?php ActiveForm::end();?>


</div>

<!-- scripts -->
<script src="admin/js/jquery-latest.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/theme.js"></script>

<!-- pre load bg imgs -->
<script type="text/javascript">
    $(function () {
        // bg switcher
        var $btns = $(".bg-switch .bg");
        $btns.click(function (e) {
            e.preventDefault();
            $btns.removeClass("active");
            $(this).addClass("active");
            var bg = $(this).data("img");

            $("html").css("background-image", "url('img/bgs/" + bg + "')");
        });

    });
</script>

</body>
</html>
