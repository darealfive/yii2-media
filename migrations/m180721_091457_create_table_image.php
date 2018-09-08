<?php

namespace darealfive\media\migrations;

use darealfive\base\Migration;
use darealfive\media\models\base\Image;

/**
 * Class m180721_091457_create_table_image
 */
class m180721_091457_create_table_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($tableName = Image::tableName(), [
            'id'         => $this->primaryKey(),
            'name'       => $this->string(64)->notNull(),
            'alt'        => $this->string(64)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('current_timestamp')
        ], $this->tableOptions);

        /*
         * It is not allowed to use the same position for a group of records
         */
        $this->createIndexAutoName($tableName, ['name'], true);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Image::tableName());

        return true;
    }
}
