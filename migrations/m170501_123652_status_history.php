<?php

use yii\db\Schema;
use yii\db\Migration;

class m170501_123652_status_history extends Migration
{
    public function up()
    {
      $this->createTable('status_history', [
    		'id' => $this->primaryKey(),
    		'start_status_id' => $this->string(255),
    		'end_status_id' => $this->string(255),
    		'owner_id' => $this->string(45) . ' NOT NULL',
    		'create_time' => $this->integer(),
    		'author_id' => $this->integer()
    	]);
    }

    public function down()
    {
        $this->dropTable('status_history');

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
