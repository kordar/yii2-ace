<?php

use yii\db\Migration;

class m170108_092551_sidebar extends Migration
{
    const TABLE = '{{%sidebar}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'href' => $this->string(128)->notNull()->defaultValue('#'),
            'parent_id' => $this->integer()->defaultValue(0)->comment('higher level, 0 for the top'),
            'language' => $this->string()->notNull()->defaultValue('zh-cn'),
            'icon' => $this->string(),
            'active' => $this->smallInteger()->defaultValue(0),
            'sort' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('set the sidebar status, the default 1 is active'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
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
