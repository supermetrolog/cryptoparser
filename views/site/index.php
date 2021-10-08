<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Coin Parser';
?>
<h1 class="text-center my-3">COINGECKO</h1>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Coin name</th>
      <th scope="col">
          Price 
          <a href="?sort=-price_int">
              <i class="fas fa-sort-amount-down"></i>
        </a>
         <a href="?sort=price_int">
              <i class="fas fa-sort-amount-down-alt"></i>
        </a>
    </th>
      <th scope="col">1h</th>
      <th scope="col">24h</th>
      <th scope="col">7d</th>
      <th scope="col">24h Voluem</th>
      <th scope="col">Mkt Cap</th>
      <th scope="col">Last 7 Days</th>
    </tr>
  </thead>
  <tbody>
      <?foreach($coins as $key => $coin):?>
    <tr>
      <td><strong><?=$key?></strong></td>
      <td class="d-flex align-self-center align-item-center"><strong class="text-info"><?=$coin['name']?></strong></td>
      <td><span class="text-warning"><?=$coin['price']?></span></td>
      <td><?=$coin['change1h']?></td>
      <td><?=$coin['change24h']?></td>
      <td><?=$coin['change7d']?></td>
      <td><?=$coin['lit']?></td>
      <td><?=$coin['cap']?></td>
      <td> <img src="<?=$coin['img_src']?>"></td>
    </tr>
    <?endforeach;?>
  </tbody>
</table>