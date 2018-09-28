<?php

namespace app\module\controllers;

use yii\web\Controller;

class IndexController extends CommonController
{
    public $layout='navcommon';
    public function actionIndex()
    {
        return $this->render('index');
    }
}
