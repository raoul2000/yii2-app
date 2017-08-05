<?php

namespace app\controllers\scraper;

use Yii;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\db\Query;

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

  
}
