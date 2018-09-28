<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?><!DOCTYPE html>
<html>
<head>
    <title>必应商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="admin/">
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />
    <!-- libraries -->
    <link href="css/lib/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>




<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="form-page">
            <?php $form=ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

            <div class="row-fluid form-wrapper">
                <!-- left column -->

                <div class="span8 column">
                    <?= $this->render('/common/message');?>
                    <div class="field-box">
                        <?= $form->field($goods,'goods_name')->textInput(['class'=>'span8 inline-input','placeholder'=>'描述下商品'])?>
                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'keywords')->textInput(['class'=>'span8 inline-input','placeholder'=>'推广词'])?>
                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'shop_price')->textInput(['class'=>'span8 inline-input','placeholder'=>'本店售价'])?>

                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'promote_price')->textInput(['class'=>'span8 inline-input','placeholder'=>'促销价'])?>

                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'promote_start_date')->textInput(['class'=>'input-large datepicker'])?>

                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'promote_end_date')->textInput(['class'=>'input-large datepicker'])?>

                    </div>

                    <div class="field-box">
                        <?= $form->field($goods,'goods_num')->textInput(['class'=>'span8 inline-input','placeholder'=>'库存'])?>

                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'goods_img')->fileInput(['class'=>'span8 inline-input'])?>
                        <img src="/<?= $goods['goods_img'];?>" class="img-circle avatar hidden-phone" />

                    </div>

                    <div class="field-box">
                        <?= $form->field($goods,'goods_desc',['template'=>"{label}<div class='wysi-column'>{input}{error}</div>"]
                        )->textarea(['class'=>'span10 wysihtml5','rows'=>'5'])?>

                    </div>

                </div>

                <!-- right column -->
                <div class="span4 column pull-right">

                    <div class="field-box">
                        <?= $form->field($goods, 'cate_id',['template'=>"{label}<div class='ui-select'>{input}</div>{error}"])->dropdownList($cateList,['prompt'=>'请选择分类']); ?>

                        <!--                                <label>选择分类:</label>-->
                        <!--                                <div class="ui-select">-->
                        <!--                                    <select>-->
                        <!--                                        <option selected="" />红豆派-->
                        <!--                                        <option />大米派-->
                        <!--                                        <option />测试类-->
                        <!--                                    </select>-->
                        <!---->
                        <!--                                </div>-->
                    </div>
                    <div class="field-box">
                        <?= $form->field($goods, 'brand_id')->dropdownList($brandList,['prompt'=>'请选择品牌','class' => 'select2','style'=>'width:250px']); ?>

                        <!--                                <label>选择品牌:</label>-->
                        <!--                                <select style="width:250px" class="select2">-->
                        <!--                                    <option />-->
                        <!--                                    <option value="AK" />Alaska-->
                        <!--                                    <option value="HI" />Hawaii-->
                        <!--                                    <option value="CA" />California-->
                        <!--                                    <option value="NV" />Nevada-->
                        <!--                                    <option value="OR" />Oregon-->
                        <!--                                    <option value="WA" />Washington-->
                        <!--                                    <option value="AZ" />Arizona-->
                        <!--                                    <option value="CO" />Colorado-->
                        <!--                                </select>-->
                    </div>


                    <div class="field-box">
                        <label>加入推荐:</label>
                        <?= $form->field($goods,'is_new',['template'=>"{input}"])->checkbox(['1'=>'新品'])?>
                        <?= $form->field($goods,'is_hot',['template'=>"{input}"])->checkbox(['1'=>'热卖'])?>
                        <?= $form->field($goods,'is_best',['template'=>"{input}"])->checkbox(['1'=>'精品'])?>

                        <!--                                <label class="checkbox">-->
                        <!--                                    <input type="checkbox" /> 热卖-->
                        <!--                                </label>-->
                        <!--                                <label class="checkbox">-->
                        <!--                                    <input type="checkbox" /> 新品-->
                        <!--                                </label>-->
                        <!--                                <label class="checkbox">-->
                        <!--                                    <input type="checkbox" /> 精品-->
                        <!--                                </label>-->
                    </div>
                    <div class="field-box">
                        <?= $form->field($goods,'is_on_sale')->radioList(['1'=>'立即发布','0'=>'稍后发布'])?>
                        <!---->
                        <!--                                <label>上架:</label>-->
                        <!--                                <input type="radio" name="optionsRadios"  value="option1"  />-->
                        <!--                                        立即发布-->
                        <!--                                <input type="radio" name="optionsRadios" value="option2" />-->
                        <!--                                        稍后发布-->
                    </div>



                    <?= Html::submitButton('修改',['class'=>'btn btn-success'])?>
                    <?= Html::resetButton('重置',['class'=>'btn btn-danger'])?>


                </div>
            </div>
            <?php ActiveForm::end();?>

        </div>
    </div>
</div>
<!-- end main container -->

<!-- scripts for this page -->
<script src="js/wysihtml5-0.3.0.js"></script>
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-wysihtml5-0.0.2.js"></script>
<script src="js/bootstrap.datepicker.js"></script>
<script src="js/jquery.uniform.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/theme.js"></script>

<!-- call this page plugins -->
<script type="text/javascript">
    $(function () {

        // add uniform plugin styles to html elements
        $("input:checkbox, input:radio").uniform();

        // select2 plugin for select elements
        $(".select2").select2({
            placeholder: "Select a State"
        });

        // datepicker plugin
        $('.datepicker').datepicker().on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        // wysihtml5 plugin on textarea
        $(".wysihtml5").wysihtml5({
            "font-styles": false
        });
    });
</script>

</body>
</html>