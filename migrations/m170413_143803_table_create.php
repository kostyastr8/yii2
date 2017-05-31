<?php

use yii\db\Migration;
use yii\db\Schema;


class m170413_143803_table_create extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tbl_post}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'content' => Schema::TYPE_TEXT . '(255) NOT NULL',
            'tags' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) DEFAULT 1',
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author_id' => Schema::TYPE_INTEGER. '(11) DEFAULT NULL',


        ], $tableOptions);

        $this->createTable('{{%tbl_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),


            'salt' => Schema::TYPE_STRING . '(255) NOT NULL',
            'profile' => Schema::TYPE_INTEGER . '(255) NOT NULL',

        ], $tableOptions);



        $this->createTable('{{%tbl_tag}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT . '(255) NOT NULL',
            'frequency' => Schema::TYPE_INTEGER . '(255) NOT NULL',

        ], $tableOptions);

        $this->createTable('{{%tbl_comment}}', [
            'id' => Schema::TYPE_PK,
            'content' => Schema::TYPE_TEXT . '(255) NOT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) DEFAULT 1',
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => Schema::TYPE_STRING . '(255) NOT NULL',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'post_id' => Schema::TYPE_INTEGER. '(11) NOT NULL',

        ], $tableOptions);

        $this->createTable('{{%tbl_lookup}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT . '(255) NOT NULL',
            'code' => Schema::TYPE_INTEGER . '(255) NOT NULL',
            'type' => Schema::TYPE_STRING . '(255) NOT NULL',
            'position' => Schema::TYPE_INTEGER . '(255) NOT NULL',
        ], $tableOptions);


    }

    public function down()
    {
        $this->dropTable('{{%tbl_post}}');
        $this->dropTable('{{%tbl_user}}');
        $this->dropTable('{{%tbl_tag}}');
        $this->dropTable('{{%tbl_comment}}');
        $this->dropTable('{{%tbl_lookup}}');
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
