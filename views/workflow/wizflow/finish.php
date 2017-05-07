<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>
<div class="row">
	<div class="col-lg-12">
		<p><b>We are done : Thanks ! </b><br/>
		Here is the summary of your replies :</p>

		<div class="panel panel-default">
		  <div class="panel-body">
				<?php
				foreach($path as $step){
					echo $step->summary().'<br/>';
				}?>
		  </div>
		</div>

		<p><?= Html::a('Same player Shoot Again ...',['index','nav'=>'start'],['class' =>'btn btn-primary']) ?></p>
	</div>
</div>
