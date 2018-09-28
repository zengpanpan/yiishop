<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

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


    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>




	<!-- main container -->
    <div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>品牌修改</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                            <?=  $this->render('/common/message');?>
                            <?php $form=ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ;?>
                                <div class="span12 field-box">
                                    <?= $form->field($model,'brand_name')->textInput(['class'=>'span9'])?>
                                </div>

                                <div class="span12 field-box">
                                    <?= $form->field($model,'brand_url')->textInput(['class'=>'span9']);?>
                                </div>
                                <div class="span12 field-box">
                                    <?= $form->field($model, 'brand_logo')->fileInput(['class'=>'span9','value'=>$model->brand_logo]) ?>
                                    <img src="/<?= $model->brand_logo;?>" height="120px" width="120px" style="padding-left:100px"/>
                                </div>
                                <div class="span12 field-box">
                                    <?= $form->field($model,'is_show')->radioList(['1'=>'展示','0'=>'不展示'],['class'=>'span9'])?>
                                </div>
                                <div class="span12 field-box">
                                    <?= $form->field($model,'sort')->textInput(['class'=>'span9','placeholder'=>'排序值越大越靠前'])?>
                                </div>

                                <div class="span12 field-box textarea">
                                    <?= $form->field($model,'brand_desc')->textarea(['class'=>'span9']);?>
                                </div>
                                <div class="span11 field-box actions">
                                    <?= Html::submitButton('修改',['class'=>'btn-glow primary'])?>
                                    <?= Html::resetButton('重置',['class'=>'btn btn-danger'])?>
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
                        <h6>侧边栏文本说明</h6>
                        <p>排序：排序越小越靠前</p>
                        <p>选择下列快速通道:</p>
                        <ul>
                            <li><a href="#">品牌列表</a></li>
                            <li><a href="#">分类列表</a></li>
                            <li><a href="#"发布商品</a></li>
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