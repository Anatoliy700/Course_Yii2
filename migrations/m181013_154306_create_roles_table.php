<?php

use yii\db\Migration;

/**
 * Handles the creation of table `roles`.
 */
class m181013_154306_create_roles_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('roles', [
      'id' => $this->primaryKey(),
      'name' => $this->string(50)
    ]);
    $this->createIndex(
      'idx-role-name',
      'roles',
      'name',
      true
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('roles');
  }
}
