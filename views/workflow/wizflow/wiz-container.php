<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;
use yii\helpers\Url;

$url = Url::to(['index']);

/* @var $this yii\web\View */
?>
<div class="row">
	<div class="col-lg-12">
		<h1>wizflow</h1>
		<hr/>
	</div>
</div>

<div class="row">
	<div class="col-xs-4">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<div class="col-xs-8">
		<iframe src="<?php echo $url; ?>" width="100%" height="500px" frameBorder="0"></iframe>
	</div>
</div>
