<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_numbers}}`.
 */
class m210121_134836_create_contact_numbers_table extends Migration {

    public function safeUp() {
        $this->createTable('{{%contact_numbers}}', [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer()->notNull(),
            'number' => $this->string(24)->notNull(),
        ]);

        $this->createIndex(
            'idx-contact_numbers-contact_id',
            'contact_numbers',
            'contact_id'
        );

        $this->addForeignKey(
            'fk-contact_numbers-contact_id',
            'contact_numbers',
            'contact_id',
            'contacts',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown() {

        $this->dropForeignKey(
            'fk-contact_numbers-contact_id',
            'contact_numbers'
        );

        $this->dropIndex(
            'idx-contact_numbers-contact_id',
            'contact_numbers'
        );

        $this->dropTable('{{%contact_numbers}}');
    }
}