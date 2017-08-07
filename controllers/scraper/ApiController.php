<?php

namespace app\controllers\scraper;

use Yii;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\httpclient\Client;

class ApiController extends \yii\rest\ActiveController
{
    public $enableCsrfValidation = false;
    public $modelClass = 'app\models\scraper\ScraperModel';

    public function behaviors()
    {
      $behaviors = parent::behaviors();

      //if (YII_ENV_DEV) {
      if (true) {
        // Anela CORS in DEV only
        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
          //'class' => \yii\filters\Cors::className(),
          'class' => \app\components\Cors::className(),

          'cors' => [
              // restrict access to
              'Origin' => ['http://localhost:4200'],
              //'Origin' => "*",
              //'Access-Control-Request-Method' => ['POST', 'PUT',' GET', 'OPTIONS'],
              // Allow only POST and PUT methods
              //'Access-Control-Allow-Credentials' => true,
              // Allow OPTIONS caching
              //'Access-Control-Max-Age' => 3600,
              // Allow the X-Pagination-Current-Page header to be exposed to the browser.
              //'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
          ]
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
      }

      return $behaviors;
    }

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
