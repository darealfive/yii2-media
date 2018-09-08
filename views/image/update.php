<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model darealfive\media\models\Image */

$this->title                   = 'Update Image: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$pluginOptions = [];
if (is_string($model->getFile())) {
    $pluginOptions['initialPreview'] = [
        $model->getFile()
    ];
}
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'pluginOptions' => $pluginOptions
    ]) ?>

</div>
