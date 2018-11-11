<?php

use yii\db\Migration;

/**
 * Class m181111_143647_add_created_and_updated_filds_to_tables
 */
class m181111_143647_add_created_and_updated_filds_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('roles', 'created_at', $this->dateTime());
        $this->addColumn('roles', 'updated_at', $this->dateTime());
        
        $this->addColumn('users', 'created_at', $this->dateTime());
        $this->addColumn('users', 'updated_at', $this->dateTime());
        
        $this->addColumn('tasks', 'created_at', $this->dateTime());
        $this->addColumn('tasks', 'updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('roles', 'created_at');
        $this->dropColumn('roles', 'updated_at');
        
        $this->dropColumn('users', 'created_at');
        $this->dropColumn('users', 'updated_at');
        
        $this->dropColumn('tasks', 'created_at');
        $this->dropColumn('tasks', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181111_143647_add_created_and_updated_filds_to_tables cannot be reverted.\n";

        return false;
    }
    */
}
