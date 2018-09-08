<?php

namespace darealfive\media\models\base;

use darealfive\base\components\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "image_category".
 *
 * @property int      $image_id
 * @property int      $category_id
 * @property int      $sort
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Image    $image
 */
abstract class ImageCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_category';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'image_id'    => 'Image ID',
            'category_id' => 'Category ID',
            'sort'        => 'Sort',
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
