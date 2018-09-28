<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
	<title>必应商城 - 后台管理</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="admin/">
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/new-user.css" type="text/css" media="screen" />

    <!-- open sans font -->

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>



	<!-- main container -->
    <div class="content">

        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加发货单号</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                            <?php $form=ActiveForm::begin(['class'=>'new_user_form inline-input']);?>
                                <div class="span12 field-box">
                                    <?= $form->field($order,'shipno')->textInput(['class'=>'span9']);?>
                                </div>

                                <div class="span12 field-box textarea">
                                    <?=$form->field($order,'note')->textarea(['class'=>'span9']);?>

                                    <span class="charactersleft">有关物品相关描述,注意填写内容</span>
                                </div>
                                <div class="span11 field-box actions">
                                    <?=Html::submitButton('确认发货',['class'=>'btn-glow primary']);?>
                                    <span>OR</span>
                                    <?=Html::resetButton('取消发货',['class'=>'reset']);?>

                                </div>
                            <?php ActiveForm::end();?>
                        </div>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="btn-group toggle-inputs hidden-tablet">
                            <button class="glow left active" data-input="inline">INLINE INPUTS</button>
                            <button class="glow right" data-input="normal">NORMAL INPUTS</button>
                        </div>
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            点击上面看到内联和正常输入表单上的区别
                        </div>
                        <h6>温馨提示：</h6>
                        <p>请正确填写发货单号，否则无法正确获取物流信息。</p>
                        <p>选择下列快速通道:</p>
                        <ul>
                            <li><a href="#">订单列表</a></li>
                            <li><a href="#">控制台</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->


	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>

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