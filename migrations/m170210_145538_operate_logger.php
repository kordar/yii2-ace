<?php

use yii\db\Migration;

class m170210_145538_operate_logger extends Migration
{
    const TABLE = '{{%operate_logger}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->defaultValue('')->comment('用户'),
            'ip' => $this->string(128)->defaultValue('')->comment('操作IP'),
            'url' => $this->string(255)->defaultValue(''),
            'desc' => $this->text()->comment('操作内容'),
            'created_at' => $this->integer()->notNull()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable(self::TABLE);
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
