<?php

/* @var $this yii\web\View */

?>
<div class="site-index">
    <div class="body-content">
    	<div class="row">
    		<div class="col-lg-12">
    			<h1>Workflow View <small>experiment</small></h1>
    			<hr />
    		</div>
    	</div>
        <div class="row">
            <div class="col-lg-4">
              <p>
                The <b>yii2-workflow-view</b> extension has been designed to display a workflow in the browser.
                It is basically a Yii2 widget wrapper around the great
                <a href="http://visjs.org/" target="visjs">vis.js</a> library.
              </p>
              <p>
                Read more on the <a href="https://github.com/raoul2000/yii2-workflow-view" target="github">Github Repo</a>.
              </p>
            </div>
            <div class="col-lg-8">
                <div id="myWorkflowView" style="height:500px;">
                    <?php
                        raoul2000\workflow\view\WorkflowViewWidget::widget([
                            'workflow'    => $post,
                            'containerId' => 'myWorkflowView'
                        ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
