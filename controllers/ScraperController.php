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

    public function actionSingle()
    {
        $model = new ScraperForm();
        $responseData = null;
        $model->scraperServiceUrl = "http://127.0.0.1:5000/scraper";
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
        return $this->render('single', [
            'model' => $model,
            "responseData" => $responseData
        ]);
    }

    public function actionObject()
    {
        $model = new ScraperForm();
        $responseData = null;
        $model->scraperServiceUrl = "http://127.0.0.1:5000/scraper/object";
        if($model->load(\Yii::$app->request->post()) && $model->validate()) {
          // scrap
          // return $this->redirect(['view', 'id' => $model->id]);
          try {
            $client = new Client();
            $response = $client->createRequest()
              ->setMethod('post')
              ->setFormat(Client::FORMAT_JSON)
              ->setUrl($model->scraperServiceUrl)
              ->setData([
                'url'      => $model->url,
                'selector' => $model->selector,
                'template' => [
                    "title" => [
                      "selector" => "a > h2.tt6"
                    ],
                    "text" => [
                      "selector" => "p.txt3",
                      "value"    => "html"
                    ],
                    "url" => [
                      "selector" => ".alpha.voir_plus > a",
                      "value" => "@href"
                    ]
                  ]
              ])
              ->send();
            if ($response->isOk) {
              $responseData = $response->getData();
            }
          } catch (Exception $e) {

          }
        }
        return $this->render('object', [
            'model' => $model,
            "responseData" => $responseData
        ]);
    }

}
