<?php

namespace darealfive\media\models\base;

use darealfive\base\components\CacheableActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "image".
 *
 * @property int             $id
 * @property string          $name
 * @property string          $alt
 *
 * The followings are the available model relations:
 * @property ImageCategory[] $imageCategories
 * @property Category[]      $categories
 */
abstract class Image extends CacheableActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'id'   => 'ID',
            'name' => 'Name',
            'alt'  => 'Alternative text',
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getImageCategories()
    {
        return $this->hasMany(ImageCategory::class, ['image_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('imageCategories');
    }
}
