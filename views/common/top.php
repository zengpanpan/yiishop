<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/1
 * Time: 15:47
 */

?>
<!--头部除个人中心头部外-->
<?= $this->render("/common/_top");?>

<div class="top">
    <div class="logo"><a href="Index.html"><img src="images/logo.png" /></a></div>
    <div class="search">
        <form>
            <input type="text" value="" class="s_ipt" />
            <input type="submit" value="搜索" class="s_btn" />
        </form>
        <span class="fl"><a href="#">咖啡</a><a href="#">iphone 6S</a><a href="#">新鲜美食</a><a href="#">蛋糕</a><a href="#">日用品</a><a href="#">连衣裙</a></span>
    </div>
    <?= $this->render("/common/mycart");?>
</div>
<!--End Header End-->
<!--Begin Menu Begin-->


