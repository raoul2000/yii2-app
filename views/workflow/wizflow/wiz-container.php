<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;
use yii\helpers\Url;

$url = Url::toRoute(['index','nav'=>'start']);

/* @var $this yii\web\View */
?>
<div class="row">
	<div class="col-lg-12">
		<h1>The Wizflow Demo Page <small>experiment</small></h1>
		<hr/>
	</div>
</div>

<div class="row">
	<div class="col-xs-4">
		<p>
		The <b>Wizflow</b> is an attempt to manage a basic <em>wizard</em> using the <em>yii2-worfklow</em> extension. Basically
		the wizard UI pattern can be view as a workflow that the user is going to visit while filling-up forms and pushing the "next" button.<br/>
		Below is the workflow used by the wizard on the right.
		</p>
		<img src="images/wizflow-workflow.png" class="img-responsive" style="padding:5px;" alt="wizflow workflow">
		<p>
			The use first enters his/her name and email, and then chooses his/her favorite color. Based on this reply,
			the wizard will drive to a different form (branching). At last, the wizard displays a final form (rate).
		</p>
		<p>Read more on the <a href="https://github.com/raoul2000/yii2-wizflow" target="github">Github Repo</a>.</p>
	</div>
	<div class="col-xs-8">
			<h3>The Great Wizard</h3>
		<iframe src="<?php echo $url; ?>" width="100%" height="350px" frameBorder="0"></iframe>
	</div>
</div>
