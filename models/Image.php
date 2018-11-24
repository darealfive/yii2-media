<?php

namespace darealfive\media\models;

/**
 * This is the model class for table "image".
 */
class Image extends base\Image
{
    /**
     * @var string $_basePath where to store an image
     */
    protected $_basePath;

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->_basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['alt'], 'required'],
            [['name', 'alt'], 'string', 'max' => 64],
            [['name'], 'unique', 'on' => self::SCENARIO_DEFAULT],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'alt'],
        ];
    }
}
