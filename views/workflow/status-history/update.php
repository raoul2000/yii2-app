<?php

use yii\helpers\Html;
use raoul2000\workflow\helpers\WorkflowHelper;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$this->registerJs(
	'$("[data-toggle=\"popover\"]").popover({
    container: "body",
		html : true
});'
);
/* @var $this yii\web\View */
/* @var $model app\models\StatusHistory */
/* @var $form ActiveForm */
?>
<div class="row">
	<div class="col-lg-12">
		<h1>Workflow Playground</h1>
		<hr />
	</div>
</div>

<div class="row">
	<div class="col-lg-5">
		<div class="panel panel-info">
			<div class="panel-heading">

				<div class="btn-group pull-right">
					<a tabindex="0" class="btn btn-xs btn-default" role="button"
					data-toggle="popover" data-trigger="focus"
					data-placement="auto"
					data-content="This is the current status of the Post model. Below is the
					status <em>label</em>, and in the footer is the <em>status Id</em>.">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="info"></span>
					</a>
				</div>

				<h3 class="panel-title">
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					Current Status Label
				</h3>
			</div>
			<div class="panel-body">
				<h1 class="text-center">
      	<?php if( ! $model->hasWorkflowStatus() ) :?>
					<em>no status</em>
				<?php else:?>
					<?php
						$status = $model->getWorkflowStatus();
						echo  '<span class="label label-default" style="background-color:'.
							$status->getMetadata('color').'">'.
							$status->getLabel()
						.'</span>'
					 ?>
				<?php endif;?>
				</h1>
			</div>
			<div class="panel-footer">
				<?php
					if(  ! $model->hasWorkflowStatus() ) {
						echo "status Id : <em>(empty)</em>";
					} else {
						echo "status Id : <code> " .  $model->getWorkflowStatus()->getId() . "</code>";
					}
				 ?>
			</div>
    </div>

		<div class="panel panel-primary">
			<div class="panel-heading">

				<div class="btn-group pull-right">
					<a tabindex="0" class="btn btn-xs btn-default" role="button"
					data-toggle="popover" data-trigger="focus"
					data-placement="auto"
					data-content="Use this form to update the Post model and change its status to make
					it evolve through the workflow.<br/> Note that some <em>validation rules</em> have been
					attached to some transitions ...">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="info"></span>
					</a>
				</div>

				<h3 class="panel-title">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					The Post Model
				</h3>
			</div>

			<div class="panel-body" style="background-color:#f5f5f5">
		    <?php $form = ActiveForm::begin(); ?>
				<div class="alertdalert-warning">
				    <?php
				    	if( $model->hasWorkflowStatus()) {
							$radionListData = array_merge(
								[$model->getWorkflowStatus()->getId() => 'no change'],
								\raoul2000\workflow\helpers\WorkflowHelper::getNextStatusListData($model)
							);
				    	} else {
				    		$radionListData = \raoul2000\workflow\helpers\WorkflowHelper::getNextStatusListData($model);
				    	}
				    	echo $form->field($model, 'status')->radioList($radionListData)
				    ?>
				</div>
			    <?= $form->field($model, 'title')->textInput(['maxlength' => 45]) ?>

			    <?= $form->field($model, 'body')->textarea(['rows' => 3]) ?>

			    <?= $form->field($model, 'category')->textInput(['maxlength' => 45]) ?>

			    <?= $form->field($model, 'tags')->textInput(['maxlength' => 255]) ?>

			    <div class="form-group">
			        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
			    </div>

		    <?php ActiveForm::end(); ?>
			</div>
		</div><!-- end of form -->
	</div>


	<div class="col-lg-7">
		<div class="panel panel-info">
			<div class="panel-heading">

				<div class="btn-group pull-right">
					<a tabindex="0" class="btn btn-xs btn-default" role="button"
					data-toggle="popover" data-trigger="focus"
					data-placement="auto"
					data-content="This is the workflow defined for the Post model. Status colors and labels
					are also part of the definition, they are defined as <em>status metadata</em> and can be
					extended to fit your needs.">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="info"></span>
					</a>
				</div>


				<h3 class="panel-title">
					<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> The Post Workflow</h3>
			</div>
			<div class="panel-body">
 				<img src="images/post-workflow.png" alt="post-workflow" class="img-responsive">
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">

				<div class="btn-group pull-right">
					<a tabindex="0" class="btn btn-xs btn-default" role="button"
					data-toggle="popover" data-trigger="focus"
					data-placement="auto"
					data-content="Follow the workflow path the Post model has been through, from the first
					status (<em>draft</em>) to the current one.">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="info"></span>
					</a>
				</div>


				<h3 class="panel-title"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Status History</h3>
			</div>
			<div class="panel-body">
				<div style="max-height: 300px; overflow: auto;">
					<?php if(count($steps) == 0 ):?>
						no steps
					<?php else:?>
			            <table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Transition</th>
									<th>Status Label</th>
									<th>Time</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$index = count($steps);

								while($index) {
									$current = $steps[--$index];

									if( $current->start_status_id == null ) {
										$startId = '(no status)';
										$startLabel = '<em>enter into workflow</em>';
									} else {
										$startId = $current->start_status_id;

										$status = $model->getWorkflowSource()->getStatus( $current->start_status_id);
										$startLabel =  '<span class="label label-default" style="background-color:'.
											$status->getMetadata('color').'">'.
											$status->getLabel()
										.'</span>';

									}

									if( $current->end_status_id == null ) {
										$endId = '(no status)';
										$endLabel = '<em>leave workflow</em>';
									} else {
										$endId = $current->end_status_id;

										$status = $model->getWorkflowSource()->getStatus( $current->end_status_id);
										$endLabel =  '<span class="label label-default" style="background-color:'.
											$status->getMetadata('color').'">'.
											$status->getLabel()
										.'</span>';
									}

									?>
				               		<tr>
										<td><?= $index?></td>
										<td><?= $startId ?> to <?= $endId ?></td>
										<td><?= $startLabel ?> to <?= $endLabel ?></td>
										<td><?= Yii::$app->formatter->asDate($current->create_time,'HH:mm:ss') ?></td>
									</tr>
								<?php } ?>
			 				</tbody>
						</table>
					<?php endif;?>
				</div>
			</div><!-- //end panel body -->
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">

				<div class="btn-group pull-right">
					<a tabindex="0" class="btn btn-xs btn-default" role="button"
					data-toggle="popover" data-trigger="focus"
					data-placement="auto"
					data-content="Events fired by yii2-workflow when the Post model changes status. Attach your own
					handler to these events to customize model behavior.">
						<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="info"></span>
					</a>
				</div>


				<h3 class="panel-title"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Workflow Events</h3>
			</div>
			<div class="panel-body">
				<?php if(count($events) == 0 ):?>
					no event
				<?php else:?>
			            <table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Event Name</th>
							<th>Origin</th>
						</tr>
					</thead>
					<tbody>
							<?php
								$index=0;
								foreach($events as $event) {
									$index++;
									$eventName = $event->name;
									if( $eventName == 'EVENT_BEFORE_CHANGE_STATUS' || $eventName == 'EVENT_AFTER_CHANGE_STATUS') {
										$origin = '<em>default</em>';
									} else {
										$origin = 'Sequence';
									}

								?>
			               		<tr>
							<td><?= $index?></td>
							<td><code><?= $eventName ?></code></td>
							<td><?= $origin ?></td>
						</tr>
							<?php } ?>
						 </tbody>
				</table>
				<?php endif;?>
			</div>
			<?php
				if( $model->eventSequence) {
					$eventSequenceClassname = get_class(Yii::$app->get($model->eventSequence));
				}
			?>
			<div class="panel-footer">Event Sequence : <code><?= $eventSequenceClassname ?></code></div>
		</div>
	</div>
</div>
