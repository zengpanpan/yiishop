<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/2/22
 * Time: 20:56
 */
$info=Yii::$app->session->getFlash('info');

?>
<?php if(isset($info)&&$info['status']==1){?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>success!</strong> <?= $info['msg'];?>
    </div>
<?php }elseif(isset($info)&&$info['status']==0){?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>error!</strong> <?= $info['msg'];?>
    </div>
<?php } ?>
