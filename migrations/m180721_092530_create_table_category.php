<?php

namespace darealfive\media\migrations;

use darealfive\base\Migration;
use common\models\Category;

/**
 * Class m180721_092530_create_table_category
 */
class m180721_092530_create_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($tableName = Category::tableName(), [
            'id'         => $this->primaryKey(),
            'name'       => $this->string(32)->notNull(),
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
        $this->dropTable(Category::tableName());

        return true;
    }
}
