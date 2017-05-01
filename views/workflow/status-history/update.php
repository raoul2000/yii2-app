<?php

use yii\helpers\Html;
use raoul2000\workflow\helpers\WorkflowHelper;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

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
				<h3 class="panel-title">Current Status</h3>
			</div>
			<div class="panel-body">
            	<?php if( ! $model->hasWorkflowStatus() ) :?>
                	<h1 class="text-center">
					<em>no status</em>
				</h1>
			</div>
			<div class="panel-footer"></div>                  	
                <?php else:?>
               		<h1 class="text-center"><?= Html::encode($model->getWorkflowStatus()->getLabel()) ?></h1>
		</div>
		<div class="panel-footer">status Id : <?= $model->getWorkflowStatus()->getId()?></div>                 		
                <?php endif;?>
            </div>

	<div class="post-form well">
		
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
	</div>

	
	<div class="col-lg-7">
		<div class="panel panel-info">
			<div class="panel-heading">
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
										$startLabel =  $model->getWorkflowSource()->getStatus( $current->start_status_id)->getLabel();
									}
									
									if( $current->end_status_id == null ) {
										$endId = '(no status)';
										$endLabel = '<em>leave workflow</em>';
									} else {
										$endId = $current->end_status_id;
										$endLabel =  $model->getWorkflowSource()->getStatus( $current->end_status_id)->getLabel();
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
			<div class="panel-footer">Event Sequence : <?= $eventSequenceClassname ?></div> 
		</div>
	</div>
</div>


