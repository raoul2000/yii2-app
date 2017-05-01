<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
?>
<h1>wizflow/index</h1>
<p><?php echo Html::a('restart',['wizflow/start'])?></p>
<p>
<?php 
	$model = new app\models\wizflow\Step1Form();
	$model->favoriteColor = 'green';
	$model->status = 'Wizflow/step1';
	$model->attachBehavior('workflow', [
		'class' => '\raoul2000\workflow\base\SimpleWorkflowBehavior',
		'defaultWorkflowId' => 'Wizflow'
	]);
// 	$nextStatuses = $model->getNextStatuses(true, true);
// 	echo '<pre>'. VarDumper::dumpAsString($nextStatuses).'</pre>';
	
// 	if( count($nextStatuses) != 0) {
// 		foreach($nextStatuses as $statusId => $info) {
// 			if( $info['isValid']) {
// 				// create the next step Form instance
// 				$status = $info['status'];
					
// 				$config = $info['status']->getMetadata('model');
// 				$nextStep = Yii::createObject($config);
// 				$nextStep->status = $info['status']->getId();
					
// 				$nextStep->attachBehavior('workflow', [
// 					'class' => '\raoul2000\workflow\base\SimpleWorkflowBehavior',
// 					'defaultWorkflowId' => 'Wizflow'
// 				]);

// 				echo '<pre>'. VarDumper::dumpAsString($nextStep).'</pre>';
// 			}
// 		}
// 	}	
	$model = Yii::$app->controller->getNextStep($model);
	echo '<pre>'. VarDumper::dumpAsString($model).'</pre>';
	
// 	var_dump(Yii::$app->controller->steps);
//  	$model = Yii::$app->controller->getCurrentStep();
//  	var_dump(Yii::$app->controller->steps);
//  	$model->name = 'name';
//  	$model->email = 'email@mail.com';
//  	Yii::$app->controller->updateStep($model);
//  	var_dump(Yii::$app->controller->steps);
//  	$model = Yii::$app->controller->getNextStep($model);
//  	var_dump($model->getAttributes());
//  	$model->favoriteColor= 'green';
//  	Yii::$app->controller->updateStep($model);
//  	var_dump(Yii::$app->controller->steps);
//  	$model = Yii::$app->controller->getNextStep($model);
?>
</p>
