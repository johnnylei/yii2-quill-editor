<?php
namespace johnnylei\quill;
use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 17-6-7
 * Time: 上午12:17
 */
class QuillAsset extends AssetBundle
{
    public $js = [
        '//cdn.quilljs.com/1.2.6/quill.min.js',
    ];
    public $css = [
        '//cdn.quilljs.com/1.2.6/quill.snow.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}