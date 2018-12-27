<?php

namespace darealfive\media\controllers;

use darealfive\base\components\ActiveRecord;
use darealfive\base\interfaces\ModelFinder;
use darealfive\base\traits\ModelFinder as ModelFinderTrait;
use Yii;
use yii\base\ModelEvent;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use darealfive\media\models\Image;
use darealfive\media\models\UploadImage;

/**
 * ImageController implements the CRUD actions for Image model.
 *
 * @package darealfive\media\controllers
 */
class ImageController extends Controller implements ModelFinder
{
    use ModelFinderTrait;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    static::DELETE => ['POST'],
                ],
            ],
        ]);
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            /*
             * Lists all image models
             */
            static::INDEX  => [
                'class' => actions\image\Index::class,
            ],
            /*
             * Displays a single Image model.
             */
            static::READ   => [
                'class' => actions\image\View::class
            ],
            /*
             * Deletes an existing Image model.
             */
            static::DELETE => [
                'class' => actions\image\Delete::class
            ],
        ]);
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $onBeforeValidate = sprintf('on %s', UploadImage::EVENT_BEFORE_VALIDATE);
        $model            = new UploadImage([
            'scenario'        => UploadImage::SCENARIO_UPLOAD,
            'basePath'        => $this->module->imageBasePath,
            $onBeforeValidate => function (ModelEvent $event) {
                /** @var UploadImage $model */
                $model = $event->sender;
                $model->setFile(UploadedFile::getInstance($model, 'file'));
            }
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect([static::READ, 'id' => $model->primaryKey]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id, new UploadImage());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect([static::READ, 'id' => $model->primaryKey]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Gets the desired model to be found by @see findModel
     *
     * @return ActiveRecord
     */
    protected function getModel(): ActiveRecord
    {
        return new Image();
    }
}
