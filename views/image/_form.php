<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model darealfive\media\models\Image */
/* @var $form yii\widgets\ActiveForm */
/* @var $pluginOptions array */

$pluginOptions = isset($pluginOptions) ? $pluginOptions : [];
?>

<div class="image-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options'       => ['accept' => 'image/*'],
        'pluginOptions' => array_merge($pluginOptions, [
            'showCaption' => false,
            'showRemove'  => false,
            'showUpload'  => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon'  => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Select Photo',
        ]),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
