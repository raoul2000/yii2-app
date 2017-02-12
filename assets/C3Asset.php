<?php

namespace app\assets;

use yii\web\AssetBundle;

class C3Asset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files for this asset bundle.
     */
    public $sourcePath = '@bower/c3js-chart';

    /**
     * @var array list of JavaScript files that this bundle contains.
     */
    public $js = [
        'c3.min.js',
    ];

    /**
     * @var array list of CSS files that this bundle contains.
     */
    public $css = [
        'c3.min.css'
    ];

    /**
     * @var array list of bundle class names that this bundle depends on.
     */
    public $depends = [
        'app\assets\D3Asset'
    ];
}
