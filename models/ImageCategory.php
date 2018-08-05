<?php

namespace darealfive\media\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "image_category".
 */
class ImageCategory extends base\ImageCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'category_id', 'sort'], 'required'],
            [['image_id', 'category_id', 'sort'], 'integer'],
            [['image_id', 'category_id'], 'unique', 'targetAttribute' => ['category_id', 'image_id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::class,
             'targetAttribute'                    => ['image_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class,
             'targetAttribute'                       => ['category_id' => 'id']],
        ];
    }
}
