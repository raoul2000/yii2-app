<?php

namespace app\models\wizflow;

use Yii;
use yii\base\Model;
use raoul2000\workflow\validation\WorkflowScenario;

/**
 * ContactForm is the model behind the contact form.
 */
class BlueForm extends Model
{
    public $blueStuff;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['blueStuff'], 'required', 'message' => 'Please make an effort !'],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'blueStuff' => 'Name something blue',
        ];
    }
    public function summary()
    {
      return 'you find <b>'.$this->blueStuff.'</b> to be blue.';
    }
}
