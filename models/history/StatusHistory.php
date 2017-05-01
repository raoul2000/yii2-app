<?php

namespace app\models\history;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%status_history}}".
 *
 * @property integer $id
 * @property string $start_status_id
 * @property string $end_status_id
 * @property string $owner_id
 * @property integer $create_time
 * @property integer $author_id
 */
class StatusHistory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%status_history}}';
    }

    /**
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['owner_id'], 'required'],
        	[['author_id', 'create_time'], 'integer'],
            [['start_status_id','end_status_id'], 'string', 'max' => 45]
        ];
    }
    /**
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
    	return [
    		[
    			'class' => TimestampBehavior::className(),
    			'createdAtAttribute' => 'create_time',
    			'updatedAtAttribute' => false
    		],    		
	        [
	            'class' => BlameableBehavior::className(),
	            'createdByAttribute' => 'author_id',
	            'updatedByAttribute' => false
	        ]
    	];
    }

    public function assignTransition($event, $model)
    {
    	$this->start_status_id = ($event->getStartStatus() != null ? $event->getStartStatus()->getId() : null);
    	$this->end_status_id   = ($event->getEndStatus()   != null ? $event->getEndStatus()->getId()   : null);
    	$this->owner_id = $model->id;
    }
}
