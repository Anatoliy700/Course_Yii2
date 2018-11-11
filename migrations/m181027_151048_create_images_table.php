<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m181027_151048_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'task_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        
        $this->addForeignKey(
            'fk_images_task-id',
            'images',
            'task_id',
            'tasks',
            'id'
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('images');
    }
}
