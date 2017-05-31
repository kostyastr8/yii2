<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup'],['enctype' => 'multipart/form-data']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($modelUploading, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

<!--            --><?php
//
//            $items = [
//                'Активный' => [
//                    '0' => 'Админ',
//                    '1' => 'Модератор',
//                    '2' => 'Пользователь',
//                ],
//                'Отключен' => [
//                    '3' => 'За нарушения',
//                    '4' => 'Самостоятельно',
//                ],
//                'Удален' => [
//                    '5' => 'Админом',
//                    '6' => 'Самостоятельно',
//                ],
//            ];
//            $params = [
//                'prompt' => 'Выберите статус...',
//            ];
//            echo $form->field($model, 'status')->dropDownList($items,$params);
//
//            ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>



        </div>
    </div>
</div>


