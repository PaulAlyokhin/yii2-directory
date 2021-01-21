<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m210121_134800_create_contacts_table extends Migration {

    public function safeUp() {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(256)->notNull(),
            'last_name' => $this->string(256)->null()->defaultValue(null),
            'email' => $this->string(512)->null()->defaultValue(null),
            'birthday' => $this->date()->null()->defaultValue(null),
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%contacts}}');
    }
}