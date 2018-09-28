<?php

return [
    'adminEmail' => 'admin@example.com',
    'page'=>[
        'pageSize'=>3,
    ],
    'shipWay'=>[
        1=>['shipid'=>1,'isdefault'=>1,'shipprice'=>0,'shipname'=>'顺丰','shipcode'=>'sf','shipdesc'=>'江、浙、沪地区首重为15元/KG，其他地区18元/KG，续重均为5-6元/KG， 云南地区为8元'],
        2=>['shipid'=>2,'isdefault'=>0,'shipprice'=>10,'shipname'=>'全峰','shipcode'=>'qf','shipdesc'=>'江、浙、沪地区首重为10元/KG，其他地区15元/KG，续重均为3-4元/KG， 云南地区为6元'],
        3=>['shipid'=>3,'isdefault'=>0,'shipprice'=>8,'shipname'=>'圆通','shipcode'=>'yt','shipdesc'=>'江、浙、沪地区首重为8元/KG，其他地区10元/KG，续重均为2-3元/KG， 云南地区为5元'],
    ],
    'payment'=>[
        'alipay'=>['payid'=>1,'payname'=>'支付宝','paycode'=>'alipay','payfee'=>0.006],
        'wechat'=>['payid'=>2,'payname'=>'微信','paycode'=>'wechat','payfee'=>0.005],
        'qq'=>['payid'=>3,'payname'=>'QQ钱包','paycode'=>'qq','payfee'=>0.004],
    ],
];
