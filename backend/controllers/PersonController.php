<?php

namespace backend\controllers;

use yii\rest\ActiveController;
use yii;
use yii\web\Response;

class PersonController extends ActiveController
{

    public $modelClass = 'common\models\Person';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['update']);
        return $actions;
    }

    public function beforeAction($action)
    {
        if($action->id === 'create'){
            // save json to

            $rawData = Yii::$app->getRequest()->getBodyParams();

            echo ('$action->id create' . PHP_EOL);
            var_dump($rawData);
        }

        return false;
        //return parent::beforeAction($action);
    }
}