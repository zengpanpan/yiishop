<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/21
 * Time: 9:03
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!DOCTYPE html>
<html>
<head>
    <title>必应商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="admin/css/layout.css" />
    <!-- 下拉框高度-->
    <link rel="stylesheet" type="text/css" href="admin/css/common.css" />
    <link rel="stylesheet" type="text/css" href="admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="admin/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="admin/css/lib/font-awesome.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="admin/css/compiled/new-user.css" type="text/css" media="screen" />



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>



<!-- end sidebar -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>修改分类</h3>
            </div>
            <?php $form=ActiveForm::begin();?>
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?=  $this->render('/common/message');?>
                        <div class="span12 field-box">
                            <?= $form->field($cate, 'pid')->dropdownList($list,['prompt'=>'顶级分类']); ?>
                        </div>
                        <div class="span12 field-box">
                            <?= $form->field($cate,'cate_name')->textInput(['class'=>'span5','placeholder'=>'分类名']);?>

                        </div>


                        <div class="span12 field-box">
                            <?= $form->field($cate,'sort')->textInput(['class'=>'span5','placeholder'=>'排序值越大越靠前']);?>
                        </div>


                        <div class="span11 field-box actions">
                            <?= Html::submitButton('修改',['class'=>'btn-glow primary']);?>
                            <?= Html::resetButton('重置',['class'=>'btn btn-danger'])?>

                        </div>

                    </div>
                </div>
                <?php ActiveForm::end();?>
                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">

                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧修改分类相关信息，包括分类名 排序 上级分类
                    </div>
                    <h6>重要提示：</h6>
                    <p>排序可不填默认值为100</p>
                    <p>请谨慎修改</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end main container -->


<!-- scripts -->
<script src="admin/js/jquery-latest.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/theme.js"></script>

<script type="text/javascript">
    $(function () {

        // toggle form between inline and normal inputs
        var $buttons = $(".toggle-inputs button");
        var $form = $("form.new_user_form");

        $buttons.click(function () {
            var mode = $(this).data("input");
            $buttons.removeClass("active");
            $(this).addClass("active");

            if (mode === "inline") {
                $form.addClass("inline-input");
            } else {
                $form.removeClass("inline-input");
            }
        });
    });
</script>

</body>
</html>

