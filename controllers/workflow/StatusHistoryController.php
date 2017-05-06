<?php

namespace app\controllers\workflow;

use Yii;
use yii\web\Controller;
use app\models\history\Post;
use yii\web\NotFoundHttpException;
use app\models\history\StatusHistory;


class StatusHistoryController extends Controller
{
	public function init()
	{
		Yii::setAlias('@workflowDefinitionNamespace','app\\models\\history');
	}
	/**
	 *
	 */
    public function actionIndex()
    {
				return $this->redirect(['update']);
    }

    /**
     *
     * @param string $id
     * @return \yii\web\Response|Ambigous <string, string>
     */
    public function actionUpdate($id=null)
    {
			$this->purge();

    	if( $id == null) {
    		$model = new Post();
    		$steps = [];
    		Yii::$app->session->set('wevents',[]);
    	} else {
        	$model = $this->findModel($id);
        	$steps = StatusHistory::find()
        		->where(['owner_id' => $model->id])
        		->all();
    	}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->set('wevents',$model->getWorkflowEvents() );
        	return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'steps' => $steps,
            	'events' => Yii::$app->session->get('wevents',[])
            ]);
        }
    }

    protected function findModel($id)
    {
    	if (($model = Post::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

		/**
		 * Purge Post models after 5 days until the latest update.
		 */
		protected function purge()
		{
			$maxRetention = time() - (3600 * 24 * 5);
			//$maxRetention = time();

			$postToDelete = Post::find()
			->where( [ 'or', "updated_at < $maxRetention", "updated_at is NULL"])
			->all();
			Yii::trace("found : ". count($postToDelete));
			foreach ($postToDelete as $post) {
				StatusHistory::deleteAll(['owner_id' => $post->id]);
				$post->delete();
			}
		}
}
