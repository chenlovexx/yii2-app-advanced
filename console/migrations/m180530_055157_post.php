<?php

use yii\db\Migration;

/**
 * Class m180530_055157_post
 */
class m180530_055157_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180530_055157_post cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		$this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);
    }

    public function down()
    {
        /* echo "m180530_055157_post cannot be reverted.\n";

        return false; */
		$this->dropTable('post');
    }
    
}
