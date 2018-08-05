<?php

namespace darealfive\media\migrations;

use darealfive\base\Migration as BaseMigration;
use common\models\ImageCategory;
use common\models\Category;
use common\models\Image;

/**
 * Class m180721_093309_create_table_image_category
 */
class m180721_093309_create_table_image_category extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($tableName = ImageCategory::tableName(), [
            'image_id'    => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'sort'        => $this->smallInteger()->unsigned()->notNull(),
        ], $this->tableOptions);

        $this->addPrimaryKey($tableName, $tableName, ['category_id', 'image_id']);

        $this->addForeignKeyAutoName($tableName, 'image_id', Image::tableName(), 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKeyAutoName($tableName, 'category_id', Category::tableName(), 'id', 'RESTRICT', 'CASCADE');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(ImageCategory::tableName());

        return true;
    }
}
