<?php
use yii\helpers\Url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <script type="text/javascript" src="js/jquery-1.11.1.min_044d0927.js"></script>

    <?= $this->render('/common/public');?>

    <script type="text/javascript" src="js/n_nav.js"></script>

    <link rel="stylesheet" type="text/css" href="css/ShopShow.css" />
    <link rel="stylesheet" type="text/css" href="css/MagicZoom.css" />
    <script type="text/javascript" src="js/MagicZoom.js"></script>

    <script type="text/javascript" src="js/num.js">
        var jq = jQuery.noConflict();
    </script>

    <script type="text/javascript" src="js/p_tab.js"></script>

    <script type="text/javascript" src="js/shade.js"></script>

    <title>尤洪</title>
</head>
<body>
<!--Begin Header Begin-->
<?= $this->render('/common/top');?>
<?= $this->render('/common/menu');?>
<!--End Menu End-->
<div class="i_bg">
    <div class="postion">
        <span class="fl"><?= $bread;?></span>
    </div>
    <div class="content">

        <div id="tsShopContainer">
            <div id="tsImgS"><a href="<?= $goodList['goods_img'];?>" title="Images" class="MagicZoom" id="MagicZoom"><img src="<?= $goodList['goods_img'];?>" width="390" height="390" /></a></div>
            <div id="tsPicContainer">
                <div id="tsImgSArrL" onclick="tsScrollArrLeft()"></div>
                <div id="tsImgSCon">
                    <ul>
                        <?php if(is_array($img)&&count($img)>0):?>
                        <?php foreach($img as $key=>$v):?>
                        <li onclick="showPic(<?=$key;?>)" rel="MagicZoom" <?php if($key==0):?>class="tsSelectImg" <?php endif;?>><img src="<?=Yii::$app->qiniu->baseUrl.$v.Yii::$app->qiniu->foostyle.Yii::$app->qiniu->thumb;?>" tsImgS="<?=Yii::$app->qiniu->baseUrl.$v;?>" width="79" height="79" /></li>
                        <?php endforeach;?>
                        <?php endif;?>
<!--                        <li onclick="showPic(1)" rel="MagicZoom"><img src="images/ps2.jpg" tsImgS="images/ps2.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(2)" rel="MagicZoom"><img src="images/ps3.jpg" tsImgS="images/ps3.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(3)" rel="MagicZoom"><img src="images/ps4.jpg" tsImgS="images/ps4.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(4)" rel="MagicZoom"><img src="images/ps1.jpg" tsImgS="images/ps1.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(5)" rel="MagicZoom"><img src="images/ps2.jpg" tsImgS="images/ps2.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(6)" rel="MagicZoom"><img src="images/ps3.jpg" tsImgS="images/ps3.jpg" width="79" height="79" /></li>-->
<!--                        <li onclick="showPic(7)" rel="MagicZoom"><img src="images/ps4.jpg" tsImgS="images/ps4.jpg" width="79" height="79" /></li>-->
                    </ul>
                </div>
                <div id="tsImgSArrR" onclick="tsScrollArrRight()"></div>
            </div>
            <img class="MagicZoomLoading" width="16" height="16" src="images/loading.gif" alt="Loading..." />
        </div>

        <div class="pro_des">
            <div class="des_name">
                <p><?= $goodList['goods_name'];?></p>
                <?= $goodList['keywords'];?>
            </div>
            <div class="des_price">
                <!--      促销显示原价和促销价          -->
                <?php if($goodList['promote_start_date']<=time()&&time()<=$goodList['promote_end_date']):?>
                    本店价格：<s>￥<?= $goodList['shop_price'];?></s><br />
                    促销价格：<b>￥<?= $goodList['promote_price'];?></b><br />
                <?php else:?>
                    本店价格：<b>￥<?= $goodList['shop_price'];?></b><br />

                <?php endif;?>
                库存：<span class="goods_num"><?= $goodList['goods_num'];?></span>
            </div>
            <div class="des_choice">
                <span class="fl">型号选择：</span>
                <ul>
                    <li class="checked">30ml<div class="ch_img"></div></li>
                    <li>50ml<div class="ch_img"></div></li>
                    <li>100ml<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_choice">
                <span class="fl">颜色选择：</span>
                <ul>
                    <li>红色<div class="ch_img"></div></li>
                    <li class="checked">白色<div class="ch_img"></div></li>
                    <li>黑色<div class="ch_img"></div></li>
                </ul>
            </div>
            <div class="des_share">
                <div class="d_sh">
                    分享
                    <div class="d_sh_bg">
                        <a href="#"><img src="images/sh_1.gif" /></a>
                        <a href="#"><img src="images/sh_2.gif" /></a>
                        <a href="#"><img src="images/sh_3.gif" /></a>
                        <a href="#"><img src="images/sh_4.gif" /></a>
                        <a href="#"><img src="images/sh_5.gif" /></a>
                    </div>
                </div>
                <div class="d_care"><a onclick="ShowDiv('MyDiv','fade')">关注商品</a></div>

            </div>
            <div class="error"></div>
            <div class="des_join">
                <div class="j_nums">
                    <input type="text" value="1" name="" class="n_ipt" />
                    <input type="button" value="" onclick="addUpdate(jq(this));" class="n_btn_1" />
                    <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />
                </div>
                <span class="fl"><a id="addCart"><img src="images/j_car.png" /></a></span>
            </div>
        </div>

        <div class="s_brand">
            <div class="s_brand_img"><img src="<?= $brand['brand_logo'];?>" width="188" height="132" /></div>
            <div class="s_brand_c"><a href="#">进入品牌专区</a></div>
        </div>


    </div>
    <div class="content mar_20">
        <div class="l_history">
            <div class="fav_t">用户还喜欢</div>
            <ul>
                <li>
                    <div class="img"><a href="#"><img src="images/his_1.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="images/his_2.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>768.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="images/his_3.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>680.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="images/his_4.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="images/his_5.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
            </ul>
        </div>
        <div class="l_list">
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current">推荐搭配</li>
                    </ul>
                </div>
                <div class="team_list">
                    <div class="img"><a href="#"><img src="images/mat_1.jpg" width="160" height="140" /></a></div>
                    <div class="name"><a href="#">倩碧补水组合套装8折促销</a></div>
                    <div class="price">
                        <div class="checkbox"><input type="checkbox" name="zuhe" checked="checked" /></div>
                        <font>￥<span>768.00</span></font> &nbsp; 18R
                    </div>
                </div>
                <div class="team_icon"><img src="images/jia_b.gif" /></div>
                <div class="team_list">
                    <div class="img"><a href="#"><img src="images/mat_2.jpg" width="160" height="140" /></a></div>
                    <div class="name"><a href="#">香奈儿邂逅清新淡香水50ml</a></div>
                    <div class="price">
                        <div class="checkbox"><input type="checkbox" name="zuhe" /></div>
                        <font>￥<span>749.00</span></font> &nbsp; 18R
                    </div>
                </div>
                <div class="team_icon"><img src="images/jia_b.gif" /></div>
                <div class="team_list">
                    <div class="img"><a href="#"><img src="images/mat_3.jpg" width="160" height="140" /></a></div>
                    <div class="name"><a href="#">香奈儿邂逅清新淡香水50ml</a></div>
                    <div class="price">
                        <div class="checkbox"><input type="checkbox" name="zuhe" checked="checked" /></div>
                        <font>￥<span>749.00</span></font> &nbsp; 18R
                    </div>
                </div>
                <div class="team_icon"><img src="images/equl.gif" /></div>
                <div class="team_sum">
                    套餐价：￥<span>1517</span><br />
                    <input type="text" value="1" class="sum_ipt" /><br />
                    <a href="#"><img src="images/z_buy.gif" /></a>
                </div>

            </div>
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current"><a href="#p_attribute">商品属性</a></li>
                        <li><a href="#p_details">商品详情</a></li>
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">

                    <table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>商品名称：迪奥香水</td>
                            <td>商品编号：1546211</td>
                            <td>品牌： 迪奥（Dior）</td>
                            <td>上架时间：2015-09-06 09:19:09 </td>
                        </tr>
                        <tr>
                            <td>商品毛重：160.00g</td>
                            <td>商品产地：法国</td>
                            <td>香调：果香调香型：淡香水/香露EDT</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>容量：1ml-15ml </td>
                            <td>类型：女士香水，Q版香水，组合套装</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>


                </div>
            </div>

            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                    <?= $goodList['goods_desc'];?>

                </div>
            </div>

            <div class="des_border" id="p_comment">
                <div class="des_t">商品评论</div>

                <table border="0" class="jud_tab" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="175" class="jud_per">
                            <p>80.0%</p>好评度
                        </td>
                        <td width="300">
                            <table border="0" style="width:100%;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="90">好评<font color="#999999">（80%）</font></td>
                                    <td><img src="images/pl.gif" align="absmiddle" /></td>
                                </tr>
                                <tr>
                                    <td>中评<font color="#999999">（20%）</font></td>
                                    <td><img src="images/pl.gif" align="absmiddle" /></td>
                                </tr>
                                <tr>
                                    <td>差评<font color="#999999">（0%）</font></td>
                                    <td><img src="images/pl.gif" align="absmiddle" /></td>
                                </tr>
                            </table>
                        </td>
                        <td width="185" class="jud_bg">
                            购买过雅诗兰黛第六代特润精华露50ml的顾客，在收到商品才可以对该商品发表评论
                        </td>
                        <td class="jud_bg">您可对已购买商品进行评价<br /><a href="#"><img src="images/btn_jud.gif" /></a></td>
                    </tr>
                </table>



                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="160"><img src="images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;向死而生</td>
                        <td width="180">
                            颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td>
                        <td>
                            产品很好，香味很喜欢，必须给赞。 <br />
                            <font color="#999999">2015-09-24</font>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td width="160"><img src="images/peo2.jpg" width="20" height="20" align="absmiddle" />&nbsp;就是这么想的</td>
                        <td width="180">
                            颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td>
                        <td>
                            送朋友，她很喜欢，大爱。 <br />
                            <font color="#999999">2015-09-24</font>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td width="160"><img src="images/peo3.jpg" width="20" height="20" align="absmiddle" />&nbsp;墨镜墨镜</td>
                        <td width="180">
                            颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td>
                        <td>
                            大家都说不错<br />
                            <font color="#999999">2015-09-24</font>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td width="160"><img src="images/peo4.jpg" width="20" height="20" align="absmiddle" />&nbsp;那*****洋 <br /><font color="#999999">（匿名用户）</font></td>
                        <td width="180">
                            颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td>
                        <td>
                            下次还会来买，推荐。<br />
                            <font color="#999999">2015-09-24</font>
                        </td>
                    </tr>
                </table>



                <div class="pages">
                    <a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a>
                </div>

            </div>


        </div>
    </div>


    <!--Begin 弹出层-关注成功 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="40"><img src="images/suc.png" /></td>
                        <td>
                            <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                            <a href="#">查看我的关注 >></a>
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="#" class="b_sure">确定</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-收藏成功 End-->


    <!--Begin 弹出层-加入购物车 Begin-->
    <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="40"><img src="images/suc.png" /></td>
                        <td>
                            <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                            <span class="dataMag"></span>
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="<?= Url::to(['cart/cart']);?>" class="b_sure">去购物车结算</a><a onclick="CloseDiv_1('MyDiv1','fade1')" class="b_buy">继续购物</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-加入购物车 End-->

    <!--Begin 弹出层-登录 Begin-->
    <div id="fadeLogin" class="black_overlay"></div>
    <div id="MyLogin" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyLogin','fadeLogin')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="40"><img src="images/suc.png" /></td>
                        <td>
                            <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">请您先登录！</span><br />

                        </td>
                    </tr>
                    <tr>
                        <td>账号：</td>
                        <td><input type="text" name="user"></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type=password name="pwd"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><span class="loginMsg"></span></td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="javascript:void(0);" id="myLogin" class="b_sure">确定</a><a href="<?= Url::to(['member/register'])?>">去注册 >></a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-登录 End-->



    <!--Begin Footer Begin -->
    <?= $this->render('/common/footer');?>
    <!--End Footer End -->
</div>

</body>

<script src="js/ShopShow.js"></script>
<script>

    $(function(){
        /**
         * 购物车添加
         */

        $("#addCart").click(function(){
            var num=$(".n_ipt").val();//商品数量
            var goods_id="<?= $goodList['goods_id'];?>";//商品id
            var url="<?= Url::to(['cart/add']);?>";

            $.get(url,{num:num,goods_id:goods_id},function(msg){

                if(msg['code']==0)//用户未登陆时
                {
                    ShowDiv('fadeLogin','MyLogin');
                }
                else if(msg['code']==1)//下架
                {
                    $(".error").html("<font color='red'>"+msg['msg']+"</font>");
                }
                else if(msg['code']==2)//库存不足
                {
                    $(".error").html("<font color='red'>"+msg['msg']+"</font>");
                }
                else if(msg['code']==3)//添加成功
                {
                    var data=msg['data'];
                    var html='购物车共有'+data.type+'种宝贝（'+data.goods_num+'件） &nbsp; &nbsp; 合计：'+data.prices+'元';
                    $(".dataMag").html(html);
                    ShowDiv_1('MyDiv1','fade1')
                }
                else if(msg['code']==4)//添加失败
                {
                    $(".error").html("<font color='red'>"+msg['msg']+"</font>");

                }

            });

        });
        /**
         * Ajax登陆
         */
        $("#myLogin").click(function(){
            var name=$('input[name="user"]').val();
            var pwd=$('input[name="pwd"]').val();
            if(name==''||pwd==''){//用户名或密码为空
                $(".loginMsg").html("<font color='red'>"+'用户名或密码不能为空'+"</font>");
                return false;
            }
            var url="<?= Url::to(['member/ajax-login']);?>";
            $.get(url,{name:name,pwd:pwd},function(msg){
                if(msg.code==1)
                {
                    location.reload();
                }
                else
                {
                    var Msg=msg.msg;
                    $(".loginMsg").html("<font color='red'>"+Msg+"</font>");
                }
            },'json');
        });
    })
</script>

<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
