<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wizflow\FinalForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-final">

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
		    	'action' => ['index']
		    ]); ?>

		         <?= $form->field($model, 'rate')->radioList([
		         	'cool' => 'That was cool',
		         	'supercool' => 'It was super cool man !',
		         ]) ?>

		        <div class="form-group">
		        	<hr/>
		        	<?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev',['index','nav'=> 'prev'],['class'=> 'btn  btn-primary', 'role'=> 'button'])?>&nbsp;
		            <?= Html::submitButton('Finish', ['class' => 'btn btn-primary']) ?>
		        </div>
		    <?php ActiveForm::end(); ?>
		</div>
	</div>


</div><!-- wizflow-step-final -->
