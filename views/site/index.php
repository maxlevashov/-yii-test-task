<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
$this->title = 'Ботинки';

?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Ботинки</h1>
    </div>

    <div class="body-content">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'color_id')->dropdownList($colors, ['prompt' => '']) ?>
            <?= $form->field($model, 'size_id')->dropdownList($sizes, ['prompt' => '']) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Очистить фильтры', ['index'], ['class' => 'btn btn-info']) ?>
            </div>
        <?php ActiveForm::end(); ?>

        <div class="row">
            <?php foreach ($offers as $offer) { ?>
            <div class="col-lg-4 mb-3">
                <h2><?= $offer->product->name ?></h2>
                <p>Цена: <?= $offer->price ?> Р</p>
                <p>Остаток: <?= $offer->amount ?></p>
                <p>Цвет: <?= $offer->color->name ?></p>
                <p>Размер: <?= $offer->size->name ?></p>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
