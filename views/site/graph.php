<?php

use app\assets\C3Asset;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

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
      <div id="chart"></div>

    </div>
  </div>
</div>
