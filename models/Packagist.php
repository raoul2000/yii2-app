<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%packagist_stat}}".
 *
 * @property integer $id
 * @property string $package_name
 * @property integer $download
 * @property integer $star
 * @property integer $create_time
 */
class Packagist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%packagist_stat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['package_name', 'download', 'star', 'create_time'], 'required'],

            [['download', 'star', 'create_time'], 'integer'],
            [['package_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package_name' => 'Package Name',
            'download' => 'Download',
            'star' => 'Star',
            'create_time' => 'Create Time',
        ];
    }
}
