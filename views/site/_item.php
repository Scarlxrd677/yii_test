<?php echo $model->content;

echo \yii2mod\comments\widgets\Comment::widget([
      'model' => $model,
]);