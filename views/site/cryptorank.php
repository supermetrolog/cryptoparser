<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Coin Parser';
?>
<h1 class="text-center">CRYPTORANK</h1>

<?

echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name:text',
        
        [
            'label' => 'Tags',
            'attribute' => 'tags',
            'format' => 'html',
            'value' => function ($data)
            {
              // echo '<pre>';
              // print_r($data);
              // echo '<hr>';

              if (!$data['tags']) {
                return null;
              }
                $tagsString = "";
                foreach ($data['tags'] as $tag) {
                    $tagsString .= "  " .Html::tag('span', $tag, ['class' => 'badge badge-success']);
                }
                return $tagsString;
            }
        ],
        'timestamp:timestamp'

    ],
]);

?>