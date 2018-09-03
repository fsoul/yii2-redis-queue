<?php

namespace backend\controllers;

use yii\rest\Controller;
use yii;
use yii\web\Response;

class PersonController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_HTML;
        return $behaviors;
    }

    public function actionCreate()
    {
        $request = Yii::$app->request->post();

        $id = Yii::$app->queue->push(new SaveToMySQL([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'phoneNumbers' => $request['phoneNumbers']
        ]));

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->statusCode = 200;

        $response->data = [
            'message' => 'ok',
            'queueID' => $id,
            'payload' => $request
        ];
    }
}