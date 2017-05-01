<?php

namespace app\controllers\workflow;

use Yii;

use yii\web\Controller;
use app\components\WizflowManager;
use yii\base\Exception;
/**
 * [
 * 		'current' => status,
 * 		'steps' => [
 * 			'Wizflow/step' => [
 * 				'class' => '\app\models\Form'
 * 				'attrib1' => 'value1',
 * 				//...
 * 				'status'     => 'Wizflow/step',
 * 				'previous'   => 'Wizflow/prev'
 * 			]
 * 		]
 * ]
 *
 *
 */
class WizflowController extends \yii\web\Controller
{

	public function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
			Yii::setAlias('@workflowDefinitionNamespace','app\\models\\wizflow');
			Yii::$app->set('workflowSource',[
				'class' => '\raoul2000\workflow\source\file\WorkflowFileSource'
			]);
		}
		return true;
	}

	/**
	 *
	 * @param string $nav
	 * @throws Exception
	 * @return Ambigous <string, string>
	 */
    public function actionIndex($nav = 'next')
    {
    	$wizard = new WizflowManager([
    		'workflowSource' => Yii::$app->get('workflowSource')
    	]);

    	if( $nav == 'prev') {
    		$model = $wizard->getPreviousStep();
    		if( $model == null) {
    			$this->redirect(['index','nav'=>'start']);
    		}
    	}elseif($nav == 'start') {
    		$model = $wizard->start();
    	}else {

    		$model = $wizard->getCurrentStep();

	    	if( $model->load(Yii::$app->request->post()) && $model->validate()) {

	    		$wizard->updateCurrentStep($model);
	    		// current step has been completed : save it and get next step
	    		$model = $wizard->getNextStep();
	    		if( $model == null) {
	    			//we reached the last step
	    			$wizard->save();
	    			return $this->redirect(['finish']);
	    		}
	    	}
    	}
    	$viewname = $model->getWorkflowStatus()->getMetadata('view');
    	$wizard->save();
        return $this->render($viewname,[
        	'model' => $model,
        	'path'  => $wizard->getPath()
        ]);
    }

    /**
     *
     * @return Ambigous <string, string>
     */
    public function actionFinish()
    {
    	$wizard = new WizflowManager([
    		'workflowSource' => Yii::$app->get('workflowSource')
    	]);
    	return $this->render('finish',[
    		'path' => $wizard->getPath()
    	]);
    }

}
