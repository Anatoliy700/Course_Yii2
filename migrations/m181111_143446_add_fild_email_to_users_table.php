<?php

use yii\db\Migration;

/**
 * Class m181111_143446_add_fild_email_to_users_table
 */
class m181111_143446_add_fild_email_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'email', $this->string(50)->notNull());
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181111_143446_add_fild_email_to_users_table cannot be reverted.\n";

        return false;
    }
    */
}
