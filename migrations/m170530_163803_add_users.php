<?php

use yii\db\Migration;

class m170530_163803_add_users extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m170530_163803_add_users cannot be reverted.\n";
//
//        return false;
//    }

    public function safeUp()
    {

        $this->insert('tbl_user', [
            'id' => '2',
            'username' => 'admin@admin.com',
            'auth_key' => '123',
            'email' => 'admin@admin.com',
            'role'=> '1'
        ]);
        $this->insert('tbl_user', [
            'id' => '3',
            'username' => ' manager@manager.com',
            'auth_key' => '123',
            'email' => ' manager@manager.com',
            'role'=> '2'
        ]);
        $this->insert('tbl_user', [
            'id' => '4',
            'username' => 'client@client.com',
            'auth_key' => '123',
            'email' => 'client@client.com',
            'role'=> '3'
        ]);
    }

    public function safeDown()
    {
        $this->delete('tbl_user', ['id' => 2]);
        $this->delete('tbl_user', ['id' => 3]);
        $this->delete('tbl_user', ['id' => 4]);
    }

}
