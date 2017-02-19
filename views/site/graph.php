<?php

use app\assets\C3Asset;
/* @var $this yii\web\View */

$this->title = 'Raoul2000';

$this->registerJsFile(
    '@web/js/chart.js',
    ['depends' => [app\assets\C3Asset::className()]]
);

$jsScript =<<<EOS
showChart('#chart');
EOS;

$this->registerJs(
    $jsScript,
    yii\web\View::POS_READY,
    'chart-view'
);
?>
<div class="site-chart">
  <div class="row">
    <div class="col-lg-12">
      <h1>Graph <small>packagist stats</small></h1>
      <hr/>
      <div id="chart"></div>
    </div>
  </div>
</div>
