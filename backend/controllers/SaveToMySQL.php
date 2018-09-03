<?php
/**
 * Created by PhpStorm.
 * User: bilinskyi
 * Date: 03.09.18
 * Time: 4:47
 */

namespace backend\controllers;

use common\models\Phone;
use yii\base\BaseObject;
use common\models\Person;


class SaveToMySQL extends BaseObject implements \yii\queue\JobInterface
{
    public $firstName;
    public $lastName;
    public $phoneNumbers;

    public function execute($queue)
    {
        $model = new Person();

        $data = [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName
        ];

        $model->attributes = $data;
        //$response = [];
        if($model->save()){
            foreach ($this->phoneNumbers as $number){
                $phone = new Phone();
                $phone->person_id = $model->id;
                $phone->number = $number;
                $phone->save();
            }
        }
    }
}