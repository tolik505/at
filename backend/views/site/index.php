<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?= \tolik505\tree\TreeWidget::widget([
        'items' => Yii::$app->params['menuItems'],
        'options' => [
            'minOpenLevels' => 5
        ]
    ]); ?>
</div>
