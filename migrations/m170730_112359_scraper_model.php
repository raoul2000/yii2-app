<?php

use yii\db\Migration;

class m170730_112359_scraper_model extends Migration
{
    public function up()
    {
      $this->createTable('scraper_model', [
    		'id' => $this->primaryKey(),
    		'name' => $this->string(),
    		'json' => $this->text()
    	]);
    }

    public function down()
    {
      $this->dropTable('scraper_model');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
