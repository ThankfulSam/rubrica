<?php

use yii\db\Migration;
use phpDocumentor\Reflection\Types\This;

/**
 * Class m210702_100650_add_newuser_table
 */
class m210702_100650_add_newuser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('new_user', [
           'id' => $this->primaryKey(),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'authKey' => $this->string(255),
            'accessToken' => $this->string(255)
        ]);
        
        $this->addForeignKey('user_to_contacts', 'contatticonpreferiti', 'user_id', 'new_user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_to_contacts', 'contatticonpreferiti');
        
        $this->dropTable('new_user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210702_100650_add_newuser_table cannot be reverted.\n";

        return false;
    }
    */
}
