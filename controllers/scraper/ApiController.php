<?php

namespace app\controllers\scraper;

use Yii;

class ApiController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\scraper\ScraperModel';

    public function checkAccess($action, $model = null, $params = [])
    {
      return true;
    }
}
