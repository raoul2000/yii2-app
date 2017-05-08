<?php

namespace app\controllers\workflow;

use Yii;
use yii\web\Controller;
use raoul2000\workflow\view\WorkflowViewWidget;
use raoul2000\workflow\view\WorkflowViewAsset;

class ViewController extends Controller
{

    public function actionIndex()
    {
    	Yii::$app->set('my_workflow_source', [
    		'class'            => 'raoul2000\workflow\source\file\WorkflowFileSource',
    		'definitionLoader' => [
    			'class'      => 'raoul2000\workflow\source\file\GraphmlLoader',
    			'path'       => '@app/models/view'
    		]
    	]);
      $post = new \app\models\view\Post();
      return $this->render('index', [
        'post' => $post
      ]);
    }

    public function actionEdit()
    {
    	Yii::$app->set('my_workflow_source', [
    		'class'            => 'raoul2000\workflow\source\file\WorkflowFileSource',
    		'definitionLoader' => [
    			'class'      => 'raoul2000\workflow\source\file\GraphmlLoader',
    			'path'       => '@app/models'
    		]
    	]);
    	WorkflowViewAsset::register($this->getView());
    	return $this->render('edit');
    }
}
