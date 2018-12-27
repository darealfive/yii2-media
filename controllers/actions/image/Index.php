<?php
/**
 * Index class file
 */

namespace darealfive\media\controllers\actions\image;

use darealfive\media\controllers\actions\Index as IndexAction;
use darealfive\media\controllers\ImageController;
use darealfive\media\models\search\Image as ImageSearch;

/**
 * Class Index lists all Image models.
 *
 * @package darealfive\media\controllers\actions\image
 *
 * @property ImageController $controller
 */
class Index extends IndexAction
{
    /**
     * Index constructor.
     *
     * @param string          $id
     * @param ImageController $controller
     * @param ImageSearch     $model
     * @param array           $config
     */
    public function __construct(string $id, ImageController $controller, ImageSearch $model, array $config = [])
    {
        parent::__construct($id, $controller, $model, $config);
    }
}