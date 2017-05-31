<?php

use yii\db\Migration;

class m170418_122411_table_rel extends Migration
{
    public function up()
    {
        $this->createIndex('idx_tbl_post__author_id', '{{%tbl_post}}', 'author_id');
        $this->addForeignKey('fk_tbl_post__author_id', '{{%tbl_post}}', 'author_id', '{{%tbl_user}}', 'id');

        $this->createIndex('idx_tbl_comment__post_id', '{{%tbl_comment}}', 'post_id');
        $this->addForeignKey('fk_tbl_comment__post_id', '{{%tbl_comment}}', 'post_id', '{{%tbl_post}}', 'id');
    }

    public function down()
    {

        $this->dropForeignKey('fk_tbl_post__author_id', '{{%tbl_post}}');
        $this->dropIndex('idx_tbl_post__author_id', '{{%tbl_post}}');


        $this->dropForeignKey('fk_tbl_comment__post_id', '{{%tbl_comment}}');
        $this->dropIndex('idx_tbl_comment__post_id', '{{%tbl_comment}}');
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
