<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 17-6-7
 * Time: 上午12:32
 */

namespace johnnylei\quill;


use yii\base\Widget;
use yii\helpers\Json;

class QuillEditor extends Widget
{
    public $editorId = 'editor';
    public $options = [
        'modules'=> [
            'toolbar'=> [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
                [[ 'header'=> 1 ], [ 'header'=> 2 ]],               // custom button values
                [[ 'list'=> 'ordered'], [ 'list'=> 'bullet' ]],
                [[ 'script'=> 'sub'], [ 'script'=> 'super' ]],      // superscript/subscript
                [[ 'indent'=> '-1'], [ 'indent'=> '+1' ]],          // outdent/indent
                [[ 'direction'=> 'rtl' ]],                         // text direction
                [[ 'size'=> ['small', false, 'large', 'huge'] ]],  // custom dropdown
                [[ 'header'=> [1, 2, 3, 4, 5, 6, false] ]],
                [[ 'color'=> [] ], [ 'background'=> [] ]],          // dropdown with defaults from theme
                [[ 'font'=> [] ]],
                [[ 'align'=> [] ]],
                ['clean'],
                ['link', 'image']
            ],
        ],
        'theme'=>'snow',
    ];

    public function run() {
        QuillAsset::register($this->view);
        $initial_js = 'var editor = new Quill("#'.$this->editorId.'", '.Json::encode($this->options).');';
        $this->view->registerJs($initial_js);
        return '<div id="'.$this->editorId.'"></div>';
    }
}