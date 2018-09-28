<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/9
 * Time: 22:32
 */
$url="http://yii.shop.com/index.php?r=order/notify";
$json=file_get_contents('9034_pay.log');
$postDate=json_decode($json,true);
$cu=curl_init();
curl_setopt($cu,CURLOPT_URL,$url);
curl_setopt($cu,CURLOPT_RETURNTRANSFER,true);//不直接输出
curl_setopt($cu,CURLOPT_POST,1);//开启POST
curl_setopt($cu,CURLOPT_POSTFIELDS,$postDate);//赋值给$url传输POST数据

$res=curl_exec($cu);
print_r($res);
curl_close($cu);
