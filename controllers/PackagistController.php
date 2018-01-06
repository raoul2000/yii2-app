<?php

/**
 * Purge packagist_stat table : delete ever other row
 * DELETE FROM `packagist_stat` WHERE from_unixtime(create_time, '%d')%2 = 0
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This the controller to RESt API related to packagist metrics
 */
class PackagistController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Packagist';

    public function actionFindAll(){

      $modelClass = $this->modelClass;

      return Yii::createObject([
          'class' => ActiveDataProvider::className(),
          'query' => $modelClass::find(),
          'pagination' => false
      ]);
    }

    public function actionSearchByPackageName($name)
    {
      $modelClass = $this->modelClass;

      return Yii::createObject([
          'class' => ActiveDataProvider::className(),
          'query' => $modelClass::find()
            ->where(['package_name' => $name]),
          'pagination' => false
      ]);
    }

    public function actionFindAllPackageName()
    {
      $modelClass = $this->modelClass;

      return Yii::createObject([
          'class' => ActiveDataProvider::className(),
          'query' => $modelClass::find()
            ->select('package_name')
            ->groupBy('package_name'),
          'pagination' => false
      ]);
    }

}
