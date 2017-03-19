<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ScraperForm */
/* @var $form ActiveForm */
?>
<div class="scraper-extract">
    <h2>Request</h2>
    <hr/>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'url') ?>
        <?= $form->field($model, 'selector') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <?php if($responseData != NULL): ?>
      <hr/>
      <h2>Response</h2>
      <pre><?php echo yii\helpers\VarDumper::dumpAsString($responseData); ?></pre>
    <?php endif; ?>
</div><!-- scraper-extract -->
