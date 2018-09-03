<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phone`.
 * Has foreign keys to the tables:
 *
 * - `person`
 */
class m180902_155710_create_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('phone', [
            'id' => $this->primaryKey(),
            'number' => $this->string(),
            'person_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `person_id`
        $this->createIndex(
            'idx-phone-person_id',
            'phone',
            'person_id'
        );

        // add foreign key for table `person`
        $this->addForeignKey(
            'fk-phone-person_id',
            'phone',
            'person_id',
            'person',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `person`
        $this->dropForeignKey(
            'fk-phone-person_id',
            'phone'
        );

        // drops index for column `person_id`
        $this->dropIndex(
            'idx-phone-person_id',
            'phone'
        );

        $this->dropTable('phone');
    }
}
