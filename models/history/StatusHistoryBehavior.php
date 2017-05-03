<?php
namespace app\models\history;

use Yii;
use yii\base\Behavior;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use app\models\history\StatusHistory;
use  \yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\base\Exception;

class StatusHistoryBehavior extends Behavior
{
	private $transition = [];
	public $transitionHistoryType = '\app\models\history\StatusHistory';
	/**
	 * @var callback
	 */
	public $saveStatusHistory = null;

	public function events()
	{
		return [
			SimpleWorkflowBehavior::EVENT_AFTER_CHANGE_STATUS => 'rememberStatus',
			ActiveRecord::EVENT_AFTER_INSERT => 'saveHistory',
			ActiveRecord::EVENT_AFTER_UPDATE => 'saveHistory'
		];
	}

	public function rememberStatus($event)
	{
		$this->transition[] = $event;
	}
	/**
	 *
	 * @param yii\base\Event $event
	 */
	public function saveHistory($event)
	{
		foreach($this->transition as $key => $event) {
			if( $this->saveStatusHistory !== null ) {
				$callback = $this->saveStatusHistory;
				if( $callback($event, $this->owner) === false){
					break;
				}
			} else {
				$history = Yii::createObject($this->transitionHistoryType);
				$history->assignTransition($event, $this->owner);
				if( ! $history->save() ) {
					throw new Exception('failed to save status history : <pre>'.VarDumper::dumpAsString($history->getErrors()).'</pre>');
				}
			}
			unset($this->transition[$key]);
		}
	}
}
