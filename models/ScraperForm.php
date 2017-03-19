<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ScraperForm extends Model
{
    public $url;
    public $selector;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['url', 'selector'], 'required'],
            ['url', 'url', 'defaultScheme' => 'http']
        ];
    }

    public function attributeLabels()
       {
           return [
               'url' => 'Target Web Page Adress',
               'selector' => 'Content Selector (jquery)'
           ];
       }
}
