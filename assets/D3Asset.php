<?php
namespace app\assets;

use yii\web\AssetBundle;

class D3Asset extends AssetBundle
{
  /**
   * @var string the directory that contains the source asset files for this asset bundle.
   */
    public $sourcePath = '@bower/d3';
    
    /**
     * @var array list of JavaScript files that this bundle contains.
     */
    public $js = [
        'd3.min.js',
    ];
    //public $depends = ['yii\web\JqueryAsset'];
}
