<?php

namespace darealfive\media\models;

use darealfive\base\CacheableActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "image".
 */
class Image extends base\Image
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uri', 'alt'], 'required'],
            [['alt'], 'string', 'max' => 64],
            [['uri'], 'string', 'max' => 128],
            [['uri'], 'unique'],
        ];
    }
}
