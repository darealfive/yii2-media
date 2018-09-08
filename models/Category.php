<?php

namespace darealfive\media\models;

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
