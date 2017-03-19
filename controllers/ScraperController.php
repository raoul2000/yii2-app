<?php

namespace app\controllers;

use Yii;
use app\models\ScraperForm;
use yii\httpclient\Client;

class ScraperController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExtract()
    {
        $model = new ScraperForm();
        $responseData = null;
        if($model->load(\Yii::$app->request->post()) && $model->validate()) {
          // scrap
          // return $this->redirect(['view', 'id' => $model->id]);
          try {
            $client = new Client();
            $response = $client->createRequest()
              ->setMethod('post')
              ->setFormat(Client::FORMAT_JSON)
              ->setUrl('http://localhost:5000/scraper')
              ->setData(['url' => $model->url, 'selector' => $model->selector])
              ->send();
            if ($response->isOk) {
              $responseData = $response->getData();
            }
          } catch (Exception $e) {

          }
        }
        return $this->render('extract', [
            'model' => $model,
            "responseData" => $responseData
        ]);
    }

}
