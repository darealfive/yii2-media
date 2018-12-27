<?php
/**
 * View class file
 */

namespace darealfive\media\controllers\actions\image;

use darealfive\media\controllers\actions\View as ViewAction;
use darealfive\media\controllers\ImageController;

/**
 * Class View displays a single Image model.
 *
 * @package darealfive\media\controllers\actions\image
 *
 * @property ImageController $controller
 */
class View extends ViewAction
{
    /**
     * View constructor.
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