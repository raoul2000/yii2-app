<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This the controller to RESt API related to packagist metrics
 */
class PackagistController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Packagist';

    public function actionAll(){

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

}
