<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Coin Parser';
?>
<h1 class="text-center">COINGECKO</h1>

<?

echo GridView::widget([
    'dataProvider' => $provider,
    'filterModel' => $filter,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name:text',
         [
            'label' => 'Price',
            'attribute' => 'price',
            'format' => ['decimal', 6],
            'value' => function ($data)
            {
                return $data['price'];
            }
        ],
        [
          'label' => "Last 7 Days",
          'attribute' => 'img_src',
          'format' => 'image'
        ],
        'timestamp:timestamp'
        
    ],
]);

?>