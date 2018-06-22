<?php

use yii\db\Migration;

/**
 * Handles adding createdBy to table `post`.
 */
class m180530_070857_add_createdBy_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'createdBy', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'createdBy');
    }
}
