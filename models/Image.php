<?php

namespace darealfive\media\models;

use Yii;
use yii\base\Event;
use yii\di\Container;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;
use UnexpectedValueException;

/**
 * This is the model class for table "image".
 */
class Image extends base\Image
{
    const SCENARIO_UPLOAD = 'upload';

    /**
     * @var string $_basePath where to store an uploaded image
     */
    private $_basePath;

    /**
     * @var UploadedFile
     */
    private $_file;

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->_basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
    }

    public function getFile()
    {
        if ($this->_file instanceof UploadedFile) {

            return $this->_file;
        }

        return $this->name;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->_file = $file;
        $this->name  = $this->_file->baseName . '.' . $this->_file->extension;
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

            [['file'], 'unique', 'targetAttribute' => ['name'], 'on' => self::SCENARIO_UPLOAD],
            [['file'], 'required', 'on' => self::SCENARIO_UPLOAD],
            [['file'], ImageValidator::class, 'skipOnEmpty' => false, 'extensions' => 'png, jpg',
             'on'                                           => self::SCENARIO_UPLOAD],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'alt'],
            self::SCENARIO_UPLOAD  => ['!name', '!file', 'alt'],
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_UPLOAD => self::OP_INSERT
        ];
    }

    protected function upload()
    {
        if (!$this->_file->saveAs($this->_basePath . DIRECTORY_SEPARATOR . $this->name)) {

            throw new UnexpectedValueException(sprintf('Can not upload file to %s', $this->name));
        }
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
