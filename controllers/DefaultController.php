<?php

namespace darealfive\media\controllers;

/**
 * Default controller for the `media` module
 *
 * @package darealfive\media\controllers
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
