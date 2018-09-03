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
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->statusCode = 200;

        $req = Yii::$app->request->post();

        $id = Yii::$app->queue->push(new SaveToMySQL([
            'firstName' => $req['firstName'],
            'lastName' => $req['lastName'],
            'phoneNumbers' => $req['phoneNumbers']
        ]));

        $response->data = ['message' => $req['firstName'].' '.$req['lastName']. ' - ' . implode('|', $req['phoneNumbers'])];

    }
}