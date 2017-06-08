<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 17-6-7
 * Time: 上午11:03
 */

namespace johnnylei\quill;

use yii\base\Exception;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\bootstrap\Html;

class QuillActiveFormEditor extends InputWidget
{
    public $editorId = 'editor';
    public $formId;
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
                ['link', 'image','video', 'formula']
            ],
        ],
        'theme'=>'snow',
    ];
    public $inputOptions = [
        'class' => 'form-control',
        'style'=>[
            'display'=>'none',
        ],
    ];

    public function run()
    {
        if(!$this->hasModel()) {
            throw new Exception('without model');
        }

        $form_selector = empty($this->formId)?'form':'#'.$this->formId;
        QuillAsset::register($this->view);
        $inputId = $this->inputOptions['id'] = isset($this->inputOptions['id'])?$this->inputOptions['id']:'editor-input';
        $initial_js = '
        var editor = new Quill("#'.$this->editorId.'", '.Json::encode($this->options).');
        jQuery("'.$form_selector.'").on("beforeSubmit", function() {
            var input = $(this).find("#'.$inputId.'");
            var delta = editor.getContents();
            input.val(JSON.stringify(delta));
//            var qdc = new window.QuillDeltaToHtmlConverter(delta.ops, window.opts_ || {});
//            var html = qdc.convert();
        });';
        $this->view->registerJs($initial_js);
        $this->inputOptions['hidden'] = true;
        $input = Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
        return $input.'<div id="'.$this->editorId.'"></div>';
    }
}
