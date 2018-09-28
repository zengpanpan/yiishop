<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/1
 * Time: 16:48
 */
use yii\helpers\Url;
?>
<!--公共导航栏-->
<div class="menu_bg">
    <div class="menu">
        <!--Begin 商品分类详情 Begin-->
        <div class="nav">
            <div class="nav_t">全部商品分类</div>
            <div class="leftNav" <?php if(!isset($this->params['show'])): ?>style="display: none;"<?php endif;?>>
                <ul>
                    <?php $num=0;?>

                    <?php foreach($this->params['menu'] as $key=>$value):?>
                    <li>
                        <div class="fj">
                            <span class="n_img"><span></span><img src="images/nav<?=$num+1;?>.png" /></span>
                            <span class="fl"><a href="<?= Url::to(['category/category-list','cate_id'=>$value['cate_id']]);?>"></a><?= $value['cate_name']?></span>
                        </div>

                        <?php $top=$num*40;?>

                        <div class="zj" style="top:-<?=$top;?>px;">

                            <?php $num++;?>

                            <div class="zj_l">
                                <?php foreach($value['son'] as $k=>$val):?>
                                <div class="zj_l_c">
                                    <h2><a href="<?= Url::to(['category/category-list','cate_id'=>$val['cate_id']]);?>"><?= $val['cate_name']?></a></h2>
                                    <?php foreach($val['son'] as $v):?>
                                    <a href="<?= Url::to(['category/category-list','cate_id'=>$v['cate_id']]);?>"><?= $v['cate_name'];?></a>|
                                    <?php endforeach;?>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="zj_r">
                                <a href="#"><img src="images/n_img1.jpg" width="236" height="200" /></a>
                                <a href="#"><img src="images/n_img2.jpg" width="236" height="200" /></a>
                            </div>
                        </div>
                    </li>

                  <?php endforeach;?>
<!--                    <li>-->
<!--                        <div class="fj">-->
<!--                            <span class="n_img"><span></span><img src="images/nav2.png" /></span>-->
<!--                            <span class="fl">食品、饮料、酒</span>-->
<!--                        </div>-->
<!--                        <div class="zj" style="top:-40px;">-->
<!--                            <div class="zj_l">-->
<!--                                <div class="zj_l_c">-->
<!--                                    <h2>零食 / 糖果 / 巧克力2</h2>-->
<!--                                    <a href="#">坚果</a>|<a href="#">蜜饯</a>|<a href="#">红枣</a>|<a href="#">牛肉干</a>|<a href="#">巧克力</a>|-->
<!--                                    <a href="#">口香糖</a>|<a href="#">海苔</a>|<a href="#">鱼干</a>|<a href="#">蜜饯</a>|<a href="#">红枣</a>|-->
<!--                                    <a href="#">蜜饯</a>|<a href="#">红枣</a>|<a href="#">牛肉干</a>|<a href="#">蜜饯</a>|-->
<!--                                </div>-->
<!--                                <div class="zj_l_c">-->
<!--                                    <h2>零食 / 糖果 / 巧克力</h2>-->
<!--                                    <a href="#">坚果</a>|<a href="#">蜜饯</a>|<a href="#">红枣</a>|<a href="#">牛肉干</a>|<a href="#">巧克力</a>|-->
<!--                                    <a href="#">口香糖</a>|<a href="#">海苔</a>|<a href="#">鱼干</a>|<a href="#">蜜饯</a>|<a href="#">红枣</a>|-->
<!--                                    <a href="#">蜜饯</a>|<a href="#">红枣</a>|<a href="#">牛肉干</a>|<a href="#">蜜饯</a>|-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="zj_r">-->
<!--                                <a href="#"><img src="images/n_img1.jpg" width="236" height="200" /></a>-->
<!--                                <a href="#"><img src="images/n_img2.jpg" width="236" height="200" /></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
        <!--End 商品分类详情 End-->
        <ul class="menu_r">
            <li><a href="<?= Url::to(['index/index']);?>">首页</a></li>
            <li><a href="Food.html">美食</a></li>
            <li><a href="Fresh.html">生鲜</a></li>
            <li><a href="HomeDecoration.html">家居</a></li>
            <li><a href="SuitDress.html">女装</a></li>
            <li><a href="MakeUp.html">美妆</a></li>
            <li><a href="Digital.html">数码</a></li>
            <li><a href="GroupBuying.html">团购</a></li>
        </ul>
        <div class="m_ad">中秋送好礼！</div>
    </div>
</div>
