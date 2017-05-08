<?php

namespace app\models\wizflow;

use Yii;
use yii\base\Model;
use raoul2000\workflow\validation\WorkflowScenario;

/**
 * ContactForm is the model behind the contact form.
 */
class GreenForm extends Model
{
    public $greenStuff;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['greenStuff'], 'required', 'message' => 'don\'t you have an idea ? come on !'],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'greenStuff' => 'Name something green',
        ];
    }
    public function summary()
    {
    	return 'you find <b>'.$this->greenStuff.'</b> to be green.';
    }
}
