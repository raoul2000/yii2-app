<?php

use yii\db\Schema;
use yii\db\Migration;

class m160625_173928_create_post extends Migration
{
    public function up()
    {
    	$this->createTable('post', [
    		'id' => $this->primaryKey(),
    		'status' => $this->string(45),
    		'title' => $this->string(45),
    		'body' => $this->string(),
    		'category' => $this->string(45),
    		'tags' => $this->string(255),
    		'created_by' => $this->integer(),
    		'created_at' => $this->integer(),
    		'updated_at' => $this->integer(),
    		'updated_by' => $this->integer()
    	]);
    }

    public function down()
    {
        $this->dropTable('post');
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
