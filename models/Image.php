<?php

namespace darealfive\media\models;

use Yii;
use yii\base\Event;
use yii\di\Container;
use UnexpectedValueException;

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

    /**
     * @param Container $container
     * @param array     $params
     * @param array     $config
     *
     * @return Image
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function buildUploadedInstance(Container $container, array $params, array $config): self
    {
        /** @var static $image */
        $image = Yii::$container->get(static::class, $params, $config);
        $image->on($image::EVENT_BEFORE_VALIDATE, function (Event $event) {
            /** @var static $image */
            $image = $event->sender;
            $image->setFile(UploadedFile::getInstance($image, 'file'));
        });

        $image->on(self::EVENT_AFTER_INSERT, [$image, 'upload']);

        return $image;
    }
}
