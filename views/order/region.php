<?php
/**
 * Created by PhpStorm.
 * User: zpp
 * Date: 2017/3/5
 * Time: 22:29
 */
?>
<?php foreach($child as $v):?>
    <option value="<?=$v['region_id'];?>"><?=$v['region_name'];?></option>
<?php endforeach;?>
