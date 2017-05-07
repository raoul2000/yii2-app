<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wizflow\GreenForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-green">

	<div class="row">
		<div class="col-xs-4">
			<?php
				foreach($path as $step){
					echo $step->summary().'<br/>';
				}
			?>
		</div>
		<div class="col-xs-8">
		    <?php $form = ActiveForm::begin([
		    	'action' => ['index','nav'=>'next']
		    ]); ?>

		        <?= $form->field($model, 'greenStuff') ?>
						<p>Green is the color of hope. I hope you can reply to the question below !</p>
		        <div class="form-group">
		        	<hr/>
		        	<?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev',['index','nav'=> 'prev'],['class'=> 'btn  btn-primary', 'role'=> 'button'])?>&nbsp;
		            <?= Html::submitButton('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['class' => 'btn btn-primary']) ?>
		        </div>
		    <?php ActiveForm::end(); ?>
		</div>
	</div>


</div><!-- wizflow-step-green -->
