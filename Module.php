<?php

namespace darealfive\media;

use darealfive\base\behaviors\property\DirectoryBehavior;
use yii\base\InvalidConfigException;

/**
 * Class Module
 *
 * @package darealfive\media
 * @property \yii\base\Module $module
 * @property string           $imageBasePath the configurable directory in which the images are located.
 */
class Module extends \darealfive\base\Module
{
    /**
     * Checks that this module is configured properly
     *
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        echo $this->imageBasePath;
        if (!is_dir($this->imageBasePath)) {

            throw new InvalidConfigException(sprintf('Path "%s" is not a directory', $this->imageBasePath));
        }
    }
}
