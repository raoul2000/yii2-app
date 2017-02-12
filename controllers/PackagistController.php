<?php

namespace app\controllers;
/**
 * This the controller to RESt API related to packagist metrics
 */
class PackagistController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Packagist';

    public function actionSearchByName($id)
    {
      $model = app\models\Packagist::find($id);
      return $model;
    }
}
