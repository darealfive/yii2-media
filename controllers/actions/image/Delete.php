<?php
/**
 * Delete class file
 */

namespace darealfive\media\controllers\actions\image;

use darealfive\media\controllers\actions\Delete as DeleteAction;
use darealfive\media\controllers\ImageController;

/**
 * Class Delete deletes an existing Image model.
 *
 * @package darealfive\media\controllers\actions\image
 *
 * @property ImageController $controller
 */
class Delete extends DeleteAction
{
    /**
     * Delete constructor.
     *
     * @param string          $id
     * @param ImageController $controller
     * @param array           $config
     */
    public function __construct(string $id, ImageController $controller, array $config = [])
    {
        parent::__construct($id, $controller, $controller, $config);
    }

}