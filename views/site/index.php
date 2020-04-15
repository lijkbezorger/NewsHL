<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>NewsHL</h1>
        <?= \yii\helpers\Html::a(
            'API V1 Doc',
            ['/api/v1/doc'],
            ['class' => 'btn btn-lg btn-success']
        ) ?>
    </div>
</div>
