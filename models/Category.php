<?php

namespace darealfive\media\models;

use darealfive\base\CacheableActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "category".
 */
class Category extends base\Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],
        ];
    }
}
