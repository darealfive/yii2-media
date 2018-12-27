<?php
/**
 * Delete class file
 */

namespace darealfive\media\controllers\actions;

use Throwable;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

/**
 * Class Delete
 *
 * @package darealfive\media\controllers\actions
 */
abstract class Delete extends ModelFinderAction
{
    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function run($id)
    {
        $this->getModelFinder()->findModel($id)->delete();

        return $this->controller->redirect([$this->controller::INDEX]);
    }
}