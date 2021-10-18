<?php

namespace app\controllers;

use app\models\BookAuthor;

class BookAuthorController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $data = BookAuthor::find()->all();
        return $this->asJson($data);
    }

    private function errorResponse($message) {

        // set response code to 400
        \Yii::$app->response->statusCode = 400;

        return $this->asJson(['error' => $message]);
    }

}
