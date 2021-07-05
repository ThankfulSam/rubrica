<?php

use yii\db\Migration;

/**
 * Class m210702_100323_add_userid_in_contatticonpreferiti
 */
class m210702_100323_add_userid_in_contatticonpreferiti extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('contatticonpreferiti', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('contatticonpreferiti', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210702_100323_add_userid_in_contatticonpreferiti cannot be reverted.\n";

        return false;
    }
    */
}
