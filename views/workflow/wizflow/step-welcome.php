<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wizflow\WelcomeForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-welcome">

	<div class="row">
		<div class="col-xs-4">
		</div>
		<div class="col-xs-8">
		    <?php $form = ActiveForm::begin([
		    	'action' => ['index','nav'=>'next']
		    ]); ?>

		        <?= $form->field($model, 'name') ?>
		        <?= $form->field($model, 'email') ?>

		        <div class="form-group">
		        	<hr/>
		            <?= Html::submitButton('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['class' => 'btn btn-primary']) ?>
		        </div>

		    <?php ActiveForm::end(); ?>
		</div>
	</div>

</div><!-- wizflow-step-welcome -->
