<?php
/**
 * View class file
 */

namespace darealfive\media\controllers\actions;

use yii\web\NotFoundHttpException;

/**
 * Class View
 *
 * @package darealfive\media\controllers\actions
 */
abstract class View extends ModelFinderAction
{
    /**
     * Displays a single model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        return $this->controller->render($this->controller::READ, [
            'model' => $this->getModelFinder()->findModel($id),
        ]);
    }
}