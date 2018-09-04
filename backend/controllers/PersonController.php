<?php

namespace backend\controllers;

use yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;

class PersonController extends yii\rest\ActiveController
{
    public $modelClass = 'common\models\Person';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'languages' => [
                    'en',
                ],
            ],
        ]);
    }

    public function beforeAction($action)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        if($action->id === 'create'){
            $request = Yii::$app->request->post();

            if(!$request){
                $response->statusCode = 404;
                $response->data = [
                    'name' => 'Not Found',
                    'message' => 'POST data required',
                    'code' => 0,
                    'status' => 404,
                ];
                return false;
            }

            $id = Yii::$app->queue->push(new SaveToMySQL([
                'firstName' => $request['firstName'],
                'lastName' => $request['lastName'],
                'phoneNumbers' => $request['phoneNumbers']
            ]));

            $response->statusCode = 200;

            $response->data = [
                'message' => 'ok',
                'code' => 1,
                'queueID' => $id,
                'payload' => $request
            ];
        }else{
            $response->statusCode = 404;
            $response->data = [
                'name' => 'Not Found',
                'message' => 'POST data required',
                'code' => 0,
                'status' => 404,
            ];
            return false;
        }
    }
}