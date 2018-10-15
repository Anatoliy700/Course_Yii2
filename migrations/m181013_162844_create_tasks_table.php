<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181013_162844_create_tasks_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('tasks', [
      'id' => $this->primaryKey(),
      'title' => $this->string(50)->notNull(),
      'description' => $this->string(255)->notNull(),
      'date' => $this->date()->notNull(),
      'user_id' => $this->integer()->notNull()
    ]);
    $this->createIndex(
      'idx-tasks-title',
      'tasks',
      'title'
    );
    $this->createIndex(
      'idx-tasks-date',
      'tasks',
      'date'
    );
    $this->addForeignKey(
      'fk-tasks-user_id',
      'tasks',
      'user_id',
      'users',
      'id',
      'CASCADE',
      'CASCADE'
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('tasks');
  }
}
