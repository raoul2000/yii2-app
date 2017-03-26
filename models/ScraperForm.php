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
    public $scraperServiceUrl;
    public $url;
    public $selector;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['scraperServiceUrl', 'url', 'selector'], 'required'],
            [['scraperServiceUrl', 'url'], 'url', 'defaultScheme' => 'http']
        ];
    }

    public function attributeLabels()
       {
           return [
              'scraperServiceUrl' => 'Web Scraper Service URL',
               'url' => 'Target Web Page Adress',
               'selector' => 'Content Selector (jquery)'
           ];
       }
}
