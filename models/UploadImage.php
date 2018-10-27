<?php
/**
 * UploadImage class file
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

namespace darealfive\media\models;

use darealfive\base\behaviors\message\MessageSender;
use darealfive\media\Module;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;

/**
 * Class UploadImage
 *
 * @package darealfive\media\models
 */
class UploadImage extends Image
{
    const SCENARIO_UPLOAD = 'upload';

    /**
     * @var UploadedFile
     */
    private $_file;

    public function getFile()
    {
        if ($this->_file instanceof UploadedFile) {

            return $this->_file;
        }

        return $this->_basePath . DIRECTORY_SEPARATOR . $this->name;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->_file = $file;
        $this->name  = $this->_file->baseName . '.' . $this->_file->extension;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        /*
         * If name has changed upload a new image and delete the old one
         */
        if (key_exists('name', $changedAttributes)) {

            if (!$this->_file->saveAs($this->_basePath . DIRECTORY_SEPARATOR . $this->name)) {

                throw new UnexpectedValueException(sprintf('Can not upload file to %s', $this->name));
            }

            /*
             * There was an old image and we have to delete it
             */
            if (!$insert) {

                $oldName = $this->getOldAttribute('name');
                if (!FileHelper::unlink($oldName)) {

                    Module::messageSenderBehavior($this)->sendMessage(
                        sprintf('Can not unlink old image %s', $oldName),
                        MessageSender::MESSAGE_CATEGORY_WARNING
                    );
                }
            }
        }
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['file'], 'unique', 'targetAttribute' => ['name'], 'on' => self::SCENARIO_UPLOAD],
            [['file'], 'required', 'on' => self::SCENARIO_UPLOAD],
            [['file'], ImageValidator::class, 'skipOnEmpty' => false, 'extensions' => 'png, jpg',
             'on'                                           => self::SCENARIO_UPLOAD],
        ]);
    }

    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_UPLOAD => ['!name', '!file', 'alt'],
        ]);
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
}