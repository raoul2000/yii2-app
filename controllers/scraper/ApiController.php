<?php

namespace app\controllers\scraper;

use Yii;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\httpclient\Client;

class ApiController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\scraper\ScraperModel';

    public function actions()
    {
      $actions = parent::actions();
      // customize the data provider preparation with the "prepareDataProvider()" method
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
      return $actions;
    }

    public function prepareDataProvider()
    {
      $modelClass = $this->modelClass;
      return new ActiveDataProvider([
          'query' => (new Query())->select(['id', 'name'])->from($modelClass::tableName())
      ]);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
      return true;
    }

    public function actionProxy() {
      $client = new Client();
      $response = $client->createRequest()
        ->setMethod('post')
        ->setFormat(Client::FORMAT_JSON)
        ->setUrl('https://raoul2000.herokuapp.com/scraper')
        ->setData([
          'url' => 'http://ass-team.fr/app/web/index.php?r=site/post-index',
          //'selector' => ''
          'selector' => '.post-container h3'
        ])
        ->send();
        if ($response->isOk) {
          return [
            'success' => true,
            'statusCode' => $response->getStatusCode(),
            'data' => $response->getData()
          ];
        } else {
          return [
            'success' => false,
            'statusCode' => $response->getStatusCode()
          ];
        }

    }
}
