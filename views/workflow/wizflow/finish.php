<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>
<h3>We are done : Thanks ! </h3>
<hr/>
<p><?= Html::a('One more time ...',['index','nav'=>'start'],['class' =>'btn']) ?></p>
<div class="row">
	<div class="col-lg-12">
		<h3>Summary</h3>
		<hr/>
		<?php
			foreach($path as $step){
				echo $step->summary().'<br/>';
			}
		?>
	</div>
</div>
