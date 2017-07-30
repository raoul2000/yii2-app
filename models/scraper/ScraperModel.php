<?php

namespace app\models\scraper;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%status_history}}".
 *
 * @property integer $id
 * @property string $name
 * @property text $json
 */
class ScraperModel extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%scraper_model}}';
    }
    public function rules()
    {
        return [
            [['name' ,'json'], 'string'],
            [['name' ,'json'], 'required'],
            ['json', 'isJSON']
        ];
    }

    public function isJSON($attribute, $params, $validator) {
      json_decode($this->$attribute);
      if( json_last_error() !== JSON_ERROR_NONE ) {
        $validator->addError($this, $attribute, 'The value "{value}" is not a valid json string');
      }
    }
}
