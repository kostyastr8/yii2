<?php

use yii\db\Migration;

class m170425_092449_tbl_file_and_rel extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_file}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->defaultValue(null),
            'name' => $this->char(255)->notNull(),
            'label' => $this->text(),
            'expansion' => $this->char(255)->notNull(),
            'size' => $this->integer(11)->defaultValue(null),
            'csrf' => $this->char(56)->defaultValue(null),
            'about_me' => $this->text(),
            'file_type' => $this->integer(1),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),


        ], $tableOptions);


        $this->createIndex('idx_tbl_file__user_id', '{{%tbl_file}}', 'user_id');
        $this->addForeignKey('fk_tbl_file__user_id', '{{%tbl_file}}', 'user_id', '{{%tbl_user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_tbl_file__user_id', '{{%tbl_file}}');
        $this->dropIndex('idx_tbl_file__user_id', '{{%tbl_file}}');

        $this->dropTable('{{%tbl_file}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
