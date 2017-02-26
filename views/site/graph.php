<?php

use app\assets\C3Asset;
/* @var $this yii\web\View */

$this->title = 'Raoul2000';

$this->registerJsFile(
    '@web/js/chart.js',
    ['depends' => [
      app\assets\C3Asset::className(),
      app\assets\AppAsset::className()
    ]]
);
?>
<div class="site-chart">
  <div class="row">
    <div class="col-lg-12">
      <h1>Graph <small>packagist stats</small></h1>
      <hr/>
    </div>

    <div class="col-lg-12">
      <div class="input-group">
        <select id="package-selection" class="form-control" name="package_name">
          <option value="">Select pagkage ...</option>
        </select>
        <span class="input-group-btn">
          <button id="btn-select-package" type="button" class="btn btn-default" disabled="disabled">Load/Unload data</button>
        </span>
      </div><!-- /input-group -->
      <hr />
    </div><!-- /.col-lg-6 -->

  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="chart"></div>
    </div>

  </div>
</div>
