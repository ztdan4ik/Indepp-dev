<?php

use yii\db\Schema;
use yii\db\Migration;

class m151111_154346_create_images_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'parId' => $this->integer()->notNull(),
            'src' => $this->string(1024),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('portfolio_image_id', 'images', 'parId', 'portfolio', 'id');

    }

    public function safeDown()
    {
        $this->dropTable('images');
        $this->dropForeignKey('portfolio_image_id', 'images');
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
