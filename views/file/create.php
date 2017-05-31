<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = 'Create File';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?></h1>




    <?php $form = ActiveForm::begin(
        [
            'id' =>'id-form',
            'action' => Url::to(['file/avatar-update']),
            'options' => [
//                'style' => 'display: none;'
            ]
        ]); ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(
        [
            'id' => 'file-input-avatar',
            'multiple' => true,
            #'accept' => 'image/jpg, image/png', 'image/jpeg'
        ]);

    ?>

    <?php ActiveForm::end(); ?>


    <?= Html::a(Yii::t('app', 'Photo Update'),
        ['update', 'id' => $model->id],
        ['id' => 'update-profile-avatar']);?>
    <div class="ajax-respond">

    </div>
</div>



<?php
$script = <<< JS
jQuery(document).ready(function(){

    $('#file-input-avatar').change(function() {
        $('#id-form').submit();
    });
    
    $('#update-profile-avatar').click(function(){
        $('#file-input-avatar').click();
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего
    });
    $('#id-form').submit(function() {
        event.preventDefault();
     
        $.ajax({
            url: $('#id-form').attr('action'),
            type: 'POST',
            data: new FormData(this),
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
     
                // Если все ОК
     
                if( typeof respond.error === 'undefined' ){
                    // Файлы успешно загружены, делаем что нибудь здесь
     
                    // выведем пути к загруженным файлам в блок '.ajax-respond'
     
                    var files_path = respond.files;
                    var html = '';
                    $.each( files_path, function( key, val ){ html += val +'<br>'; } );
                    $('.ajax-respond').html( html );
                }
                else{
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });
        return false;
    });
});


JS;
$this->registerJs($script);
?>