<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181013_160954_create_users_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('users', [
      'id' => $this->primaryKey(),
      'username' => $this->string(50)->notNull(),
      'password' => $this->string(100)->notNull(),
      'first_name' => $this->string(50)->notNull(),
      'last_name' => $this->string(50)->notNull(),
      'role_id' => $this->integer()->notNull()
    ]);
    $this->createIndex(
      'idx-users-username',
      'users',
      'username',
      true
    );
    $this->addForeignKey(
      'fk-users-role_id',
      'users',
      'role_id',
      'roles',
      'id',
      'RESTRICT',
      'CASCADE'
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('users');
  }
}
