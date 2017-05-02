<?php

namespace app\models\history;

use Yii;
use raoul2000\workflow\events\WorkflowEvent;
use yii\base\Event;
use raoul2000\workflow\validation\WorkflowScenario;
use yii\base\Exception;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $status
 * @property string $title
 * @property string $body
 * @property string $category
 * @property string $tags
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
	private $workflowEvents = [];

	public function init()
	{

	}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['status', 'title', 'category'], 'string', 'max' => 45],
            [['tags'], 'string', 'max' => 255],

        	// workflow specific validation rules ///////////////////////////////////////////

        	['status', \raoul2000\workflow\validation\WorkflowValidator::className()],
					[['body'], 'required', 'on' => [
							WorkflowScenario::enterStatus('PostWorkflow/draft')
						],
						'message' => "come on !! why create an empty post ? Please write some text ..."
					],

        	[['title','body'], 'required', 'on' => [
						WorkflowScenario::enterStatus('PostWorkflow/correction'),
						WorkflowScenario::enterStatus('PostWorkflow/ready'),
						WorkflowScenario::enterStatus('PostWorkflow/published')
					]],

        	[['tags'], 'required', 'on' => [
						WorkflowScenario::enterStatus('PostWorkflow/published'),
        		WorkflowScenario::enterStatus('PostWorkflow/archived')
        	]],
        	[['tags'], 'validateTags', 'on' => [
						WorkflowScenario::enterStatus('PostWorkflow/published'),
        		WorkflowScenario::enterStatus('PostWorkflow/archived')
        	]]
        ];
    }

    public function validateTags($attribute, $params)
    {
    	if( !empty($this->tags)) {
    		$tagList = explode(',', $this->tags);
    		if( count($tagList) < 3) {
    			$this->addError($attribute,'Enter at least 3 tags ('. count($tagList). ' entered)');
    		}
    	} else {
    		$this->addError($attribute,'please enter tags');
    	}
    }

    /**
     * (non-PHPdoc)
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
    	return [
    		\raoul2000\workflow\base\SimpleWorkflowBehavior::className(),
    		[
    			'class' => \app\models\history\StatusHistoryBehavior::className(),
//     			'saveStatusHistory' => function($status, $model) {
//     				$history = Yii::createObject('\app\models\history\StatusHistory');
//     				$history->assignStatus($status, $model);
//     				if( $history->save() === false ){
//     					throw new Exception('error : '.VarDumper::dumpAsString($history->getErrors()));
//     				}
//     				return true;
//     			}
    		]
    	];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Choose the Next Status :',
            'title' => 'Title',
            'body' => 'Body',
            'category' => 'Category',
            'tags' => 'Tags',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    public function trigger($name, Event $event = null)
    {
    	if( $event instanceof WorkflowEvent ) {
    		$this->workflowEvents[] = $event;
    	}
    	parent::trigger($name, $event);
    }
    public function getWorkflowEvents()
    {
    	return $this->workflowEvents;
    }
}
