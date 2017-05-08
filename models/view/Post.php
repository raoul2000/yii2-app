<?php

namespace app\models\view;

use Yii;
use yii\base\Exception;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * (non-PHPdoc)
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
    	return [
				[
					'class' => \raoul2000\workflow\base\SimpleWorkflowBehavior::className(),
					'source' => 'my_workflow_source'
				]
    	];
    }
}
