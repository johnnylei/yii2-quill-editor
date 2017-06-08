## yii2 quill editor
这是一个基于yii2的文本编辑框[quill rich text editor](https://quilljs.com)插件,高效，简明.使用方法，配置以及api请参考官网

## install
```
composer require --prefer-dist johnnylei/quill
```

## usage
> 直接使用
```
<?= QuillEditor::widget()?>
```
> 基于yii active form使用
```
<?php $form = ActiveForm::begin([
    'action'=>'xxx',
])
?>
<?= $form->field($model, 'content')->widget(QuillActiveFormEditor::className())?>
<input type="submit">
<?php ActiveForm::end()?>
```

