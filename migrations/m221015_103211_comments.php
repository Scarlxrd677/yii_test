<?php

use yii\db\Migration;

/**
 * Class m221015_103211_comments
 */
class m221015_103211_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', 
            [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'content' => $this->text(),
            ]
        ); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221015_103211_comments cannot be reverted.\n";

        $this->dropTable('{{%comment}}');
    }

}
