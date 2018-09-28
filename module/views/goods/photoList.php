
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
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
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/user-list.css" type="text/css" media="screen" />


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>





<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="gallery">
            <div class="row-fluid header">
                <h3>商品相册</h3>
            </div>


            <!-- gallery wrapper -->
            <div class="gallery-wrapper">
                <div class="row gallery-row">
                    <!-- single image -->

                    <div class="span3 img-container">
                        <div class="">
                            <p class="title" align="center">
                                <?=$goods_name;?>
                            </p>
                                <span class="icon edit">
                                    <i class="gallery-edit"></i>
                                </span>
                                <span class="icon trash">
                                    <i class="gallery-trash"></i>
                                </span>
                            <img src="/<?=Yii::$app->request->get('goods_img');?>" width="300px" height="300px"/>
                            <p class="title" align="center">
                                商品主图
                            </p>

                        </div>

                    </div>
                    <div>
                        <?php if(is_array($img)&&count($img)>0):?>
                        <?php foreach($img as $key=>$v):?>
                        <img src="<?=Yii::$app->qiniu->baseUrl.$img[$key];?>" width="300px" height="300px"/>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>


                    <!-- new image button -->
                    <div class="span3 new-img">
                        <a href="<?=\yii\helpers\Url::to(['goods/photo-add','goods_id'=>$goods_id]);?>"><img src="img/new-gallery-img.png" width="400px" height="400px"/></a>

                    </div>


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



</body>
</html>