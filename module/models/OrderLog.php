<?php

namespace app\module\models;

use Yii;

/**
 * This is the model class for table "{{%order_log}}".
 *
 * @property integer $olid
 * @property string $admin
 * @property string $action
 * @property integer $actiontime
 * @property string $result
 * @property string $note
 * @property string $orderno
 */
class OrderLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin', 'action', 'actiontime', 'result', 'note', 'orderno'], 'required'],
            [['actiontime'], 'integer'],
            [['admin', 'orderno'], 'string', 'max' => 30],
            [['action', 'result'], 'string', 'max' => 20],
            [['note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'olid' => 'Olid',
            'admin' => '操作者',
            'action' => '操作动作',
            'actiontime' => '操作时间',
            'result' => '操作结果',
            'note' => '操作备注',
            'orderno' => '订单号',
        ];
    }
    /**
     * 操作结果
     * @param $result
     * @return string
     */
    public static function getResult($result)
    {
        if($result>0)
        {
            return '成功';
        }
        else
        {
            return '失败';
        }
    }

    /**
     * 操作日志入库
     * @param $action
     * @param $result
     * @param $orderno
     * @return bool
     */
    public function wirte($action,$result,$orderno)
    {
        $admin=\Yii::$app->session->get('admin');
        $note="订单【".$orderno."】".$action.$result;
        $data=[
            'admin'=>$admin['admin_name'],
            'action'=>$action,
            'actiontime'=>time(),
            'result'=>$result,
            'note'=>$note,
            'orderno'=>$orderno,
        ];
        if($this->load(['OrderLog'=>$data])&&$this->validate())
        {
           return  $this->save();
        }
        return false;


    }


}
