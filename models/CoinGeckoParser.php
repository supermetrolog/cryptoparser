<?php

namespace app\models;
use yii\base\Model;
class CoinGeckoParser extends Model
{
    private $content;
    private $document;
    public function __construct($html)
    {
        $this->document = \phpQuery::newDocument($html);
    }

    public function getContent()
    {
        $this->content = $this->getCoinsData();
        return $this->content;
    }

    private function getAllCoins()
    {
        return $this->document->find('.table tr');
    }
    
    private function getCoinsData()
    {
        $coins = $this->getAllCoins();
        $data = [];
        foreach ($coins as $key => $coin) {
            if ($key == 66) {
                break;
            }
            $coin = pq($coin);
            $data[$key]['name'] =  $coin->find('.coin-name')->attr('data-sort');
            $data[$key]['timestamp'] =  time();
            $data[$key]['price'] = $coin->find('.price')->attr('data-sort');
            $data[$key]['img_src'] =  substr($coin->find('.text-center > a > img')->attr('data-srcset'), 0, -3);
           
        }
        unset($data[0]);
        return $data;
    }
}
