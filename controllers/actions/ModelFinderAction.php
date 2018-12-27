<?php

namespace darealfive\media\controllers\actions;

use darealfive\media\controllers\Controller;
use darealfive\base\interfaces\ModelFinder;

/**
 * Class ModelFinderAction
 *
 * @package darealfive\media\controllers\actions
 */
abstract class ModelFinderAction extends Action
{
    /**
     * @var ModelFinder
     */
    private $modelFinder;

    /**
     * @return ModelFinder
     */
    public function getModelFinder(): ModelFinder
    {
        return $this->modelFinder;
    }

    /**
     * ModelFinderAction constructor.
     *
     * @param string      $id
     * @param Controller  $controller
     * @param ModelFinder $modelFinder
     * @param array       $config
     */
    public function __construct(string $id, Controller $controller, ModelFinder $modelFinder, array $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->modelFinder = $modelFinder;
    }
}