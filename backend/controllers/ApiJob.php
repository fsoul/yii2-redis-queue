<?php
/**
 * Created by PhpStorm.
 * User: bilinskyi
 * Date: 03.09.18
 * Time: 4:47
 */

namespace backend\controllers;

use yii\base\BaseObject;
use common\models\Person;
use yii\helpers\BaseJson;


class ApiJob extends BaseObject implements \yii\queue\JobInterface
{
    public function execute($queue)
    {

        $data = BaseJson::decode($queue);
        $model = new Person();

        $model->attributes = $data;
        $response = [];
        $model->save();
    }
}