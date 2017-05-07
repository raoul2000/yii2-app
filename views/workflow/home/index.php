<?php
/* @var $this yii\web\View */
?>
<div class="jumbotron">
    <h1>yii2-workflow</h1>
    <p class="lead">A simple workflow Engine for your yii2</p>
    <a href="https://github.com/raoul2000/yii2-workflow" target="github" title="visit Github repo"><img src="https://img.shields.io/github/stars/raoul2000/yii2-workflow.svg" alt=""></a>
    <a href="https://github.com/raoul2000/yii2-workflow" target="github" title="visit Github repo"><img src="https://img.shields.io/github/forks/raoul2000/yii2-workflow.svg" alt=""></a>
</div>

<h2>Demo and Experiments</h2>
<hr />
<div class="row">
  <div class="col-xs-4">
    <h3><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Playground</h3>
    <p>
      See it in action on a sample <em>Post</em> model.
      This Demo includes standard features like
      <a href="http://raoul2000.github.io/yii2-workflow/overview/#workflow-driven-model-validation" target="doc"><em>Workflow Driven Model Validation</em></a> and
      <a href="http://raoul2000.github.io/yii2-workflow/concept-events/" target="doc"><em>Events</em></a>, but also an example of
      <em>Workflow transition history</em> behavior.
    </p>
    <p>
      <a class="btn btn-primary" href="?r=workflow/status-history/update">
        Try it &raquo;
      </a>
    </p>
  </div>
  <div class="col-xs-4">
    <h3>WizFlow <small>experiment</small></h3>
    <p>
      The wizard UI pattern can also be considered as a workflow where, based
      on user choices a <em>path</em> is defined step by steps from the first screen to
      the last one. Let's try to implement this pattern using yii2-workflow !
    </p>
    <p>
      <a class="btn btn-default" href="https://github.com/raoul2000/yii2-wizflow" target="yii2-wizflow-repo">
        Github Repo &raquo;
      </a>
      <a class="btn btn-primary" href="?r=workflow/wizflow/init">
        Try it &raquo;
      </a>
    </p>
  </div>
  <div class="col-xs-4">
    <h3>Workflow View <small>experiment</small></h3>
    <p>
      This is an experiment to create a yii2 widget dedicated to provide a
      graphical representation of a <em>yii2-workflow</em>. It uses the great <a href="http://visjs.org/" target="visjs">vis.js</a>
      library.<br/>&nbsp;
    </p>
    <p>
      <a class="btn btn-default" href="https://github.com/raoul2000/yii2-workflow-view" target="yii2-wizflow-repo">
        Github Repo &raquo;
      </a>
      <a class="btn btn-primary" href="#" title="Work in progress" disabled>
        coming soon ...
      </a>
    </p>
  </div>
</div>

<h2>Source And Documentation</h2>
<hr/>
<div class="row">
  <div class="col-xs-6">
    <h3>Documentation</h3>
    <p>
      yii2-workflow is a well documented extension (well at least that is my ambition). The documentation
      is updated on each release and includes many examples to illustrates various use cases. Of course it
      can be improved, so don't hesitate to contribute.
    </p>
    <p>
      <a class="btn btn-default" href="http://raoul2000.github.io/yii2-workflow/" target="yii2 guide">
        Read the doc &raquo;
      </a>
  </p>
  </div>
  <div class="col-xs-6">
    <h3>Source Code</h3>
    <p>
      The source code is hosted at Github and it is (almost) fully tested and documented. I try as much as possible
      to reply to all issues that may be posted (but it may take some time so be patient).
    </p>
    <p>
      <a class="btn btn-default" href="https://github.com/raoul2000/yii2-workflow" target="yii2 source code">
        Github Repo &raquo;
      </a>
    </p>
  </div>
</div>
