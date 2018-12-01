<?php

namespace darealfive\media\controllers;

use darealfive\base\behaviors\message\MessageReceiver;
use darealfive\base\behaviors\message\MessageEvent;
use darealfive\base\controllers\Controller as BaseController;
use darealfive\media\Module;
use Yii;

/**
 * Class Controller
 *
 * @package darealfive\media\controllers
 * @property Module $module
 *
 * @method handleMessageSent(callable $handler, $data = null, $append = true)
 * @see     MessageReceiver::handleMessageSent()
 */
abstract class Controller extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            MessageReceiver::class => ['class' => MessageReceiver::class],
        ]);
    }

    /**
     * Before action we ensure to handle every message being sent in a unified way.
     *
     * @param $action
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            $this->handleMessageSent([static::class, 'messageSentHandler']);

            return true;
        }

        return false;
    }

    /**
     * An event handler for any event triggered via the MessageEvent.
     * It handles a message being sent by adding a flash message
     *
     * @param MessageEvent $event the event being triggered
     */
    public static function messageSentHandler(MessageEvent $event)
    {
        Yii::$app->session->addFlash($event->category, $event->message);
    }
}