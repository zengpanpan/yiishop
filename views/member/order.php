        <script type="text/javascript" src="js/jquery-1.11.1.min_044d0927.js"></script>
        <script type="text/javascript" src="js/shade.js"></script>
        <script type="text/javascript" src="js/ship_express.js"></script>

		<div class="m_right">
            <p></p>
            <div class="mem_tit">我的订单</div>
            <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
<?php
use app\models\Order;
use yii\helpers\Url;
?>
                <td width="55%">订单详情</td>
                <td width="10%">订单总金额</td>
                <td width="20%">订单状态</td>
                <td width="15%">操作</td>
              </tr>
                <!-- 循环开始处 -->
                <?php foreach($orderList as $value):?>
              <tr>
                <td><font color="#ff4e00">订单号 <?=$value['orderno'];?> &nbsp;&nbsp;&nbsp;&nbsp; <?=date('Y-m-d H:i:s',$value['createtime']);?></font>
                    <table>
                        <?php foreach($value['orderGoods'] as $v):?>
                        <tr>
                            <td width="20%"><img height="60" width="60" src="<?=$v['goods_img'];?>" alt=""></td>
                            <td width="65%"><?=$v['goods_name'];?></td>
                            <td width="15%">&#935; <?=$v['buy_num'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </td>
                <td>￥<?=$value['orderamount'];?></td>
                <td>
                   <?=\app\models\Order::$orderStatus[$value['status']]?><br>
                    <?=($value['paystatus']) ?'已付款' :'未付款'?><br>
                    <?php if($value['shipstatus']==\app\models\Order::IS_SHIP):?>
                        已发货<br>
                        <a  class="ship" data-ship="<?=$value['shipno'];?>" >物流跟踪</a>
                    <?php else:?>
                        未发货
                    <?php endif;?>
                    </td>
                <td>
                    <!--  未支付时-->
                    <?php if($value['paystatus']==Order::IS_NOT_PAY):?>
                        <a class="btn-flat" href="#">立即支付</a><br>
                        <a class="btn-flat" href="#">取消订单</a>
                    <?php endif;?>
                    <!-- 已支付未发货时-->
                    <?php if($value['paystatus']==Order::IS_PAY&&$value['shipstatus']==Order::IS_NOT_SHIP):?>
                        <a class="btn-flat" href="#">提醒发货</a><br>
                        <a class="btn-flat" href="#">取消订单</a>
                    <?php endif;?>
                    <!--已支付 未完成时        -->
                    <?php if($value['status']!=Order::IS_SUCCESS_STATUS&&$value['shipstatus']==Order::IS_SHIP):?>
                        <a class="btn-flat" >确认收货</a>
                    <?php endif;?>

                    <!--完成时      -->
                    <?php if($value['status']==Order::IS_SUCCESS_STATUS):?>
                        <a class="btn-flat" >评论</a>
                    <?php endif;?>

                </td>
              </tr>
                <?php endforeach;?>
                <!-- 循环结束处 -->


            </table>
            <div class="pages">
            <?= \yii\widgets\LinkPager::widget([
                'pagination'=>$page,

            ])?>
            </div>
            <div class="mem_tit">合并订单</div>
            <table border="0" class="order_tab" style="width:930px;"  cellspacing="0" cellpadding="0">
              <tr>
                <td width="135" align="right">主订单</td>
                <td width="220">
                	<select class="jj" name="order1">
                      <option value="0" selected="selected">请选择...</option>
                      <option value="1">2015092626589</option>
                      <option value="2">2015092626589</option>
                      <option value="3">2015092626589</option>
                      <option value="4">2015092626589</option>
                    </select>
                </td>
                <td width="135" align="right">从订单</td>
                <td width="220">
                	<select class="jj" name="order2">
                      <option value="0" selected="selected">请选择...</option>
                      <option value="1">2015092626589</option>
                      <option value="2">2015092626589</option>
                      <option value="3">2015092626589</option>
                      <option value="4">2015092626589</option>
                    </select>
                </td>
                <td><div class="btn_u"><a href="#">合并订单</a></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4" style="font-family:'宋体'; padding:20px 10px 50px 10px;">
                	订单合并是在发货前将相同状态的订单合并成一新的订单。 <br />
                    收货地址，送货方式等以主定单为准。
                </td>
              </tr>
            </table>

        </div>

        <!--Begin 弹出层-物流信息 Begin-->
        <div id="fade" class="black_overlay"></div>
        <div id="MyDiv" class="white_content">
            <div class="white_d">
                <div class="notice_t">
                    <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="images/close.gif" /></span>
                </div>
                <div class="notice_c">
                    <img src="images/loadings.gif" alt="">

                </div>
            </div>
        </div>
        <!--End 弹出层-物流信息 End-->
        <script>
            $(function(){
//                <h3>菜鸟仓-圆通速递：884371885242711417</h3>
//                <hr>
//
//                您的快件已签收
//                <ul>
//                <li>2017-03-07 13:50:53 【上海市奉贤区东部 公司】 的派件员孔垂羊派件中</li>
//                <li>2017-03-07 13:50:53 【上海市奉贤区东部 公司】 的派件员孔垂羊派件中</li>
//                <li>2017-03-07 13:50:53 【上海市奉贤区东部 公司】 的派件员孔垂羊派件中</li>
//                <li>2017-03-07 13:50:53 【上海市奉贤区东部 公司】 的派件员孔垂羊派件中</li>
//
//                </ul>
//                其中快递名和签收状态通过写入ship_express.js来获取
                $(".ship").click(function(){
                    ShowDiv('MyDiv','fade');
                    var url="<?=Url::to(['member/ship']);?>";
                    var shipno=$(this).attr("data-ship");
                    $.get(url,{shipno:shipno},function(result){
                        if(result.status==200)
                        {

                            var data=result.data;
                            var com=result.com;//快递名拼音
                            var ship_name=ship['type'][com];//快递名称
                            var html="<h3>"+ship_name+':'+result.nu+"</h3><hr>";
                            html +=ship['state'][result.state];//签收状态
                            html +="<ul>";
                            $.each(data,function(key,value){//循环时段状态
                                html +="<li>"+value.time+'<br>'+value.context+"</li>"
                            });
                            html +="</ul>";
                            $(".notice_c").html(html);
                        }
                        else
                        {
                            $(".notice_c").html(result.message);

                        }

                    },'json');
                });

            });
        </script>