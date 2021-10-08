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
        $this->beginParse();
        return $this->content;
    }
    private function beginParse()
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
            $data[$key]['price_int'] = $coin->find('.price')->attr('data-sort');
            $data[$key]['price'] = $coin->find('.price > span')->text();
            $data[$key]['change1h'] =  $coin->find('.change1h > span')->text();
            $data[$key]['change24h'] =  $coin->find('.change24h > span')->text();
            $data[$key]['change7d'] =  $coin->find('.change7d > span')->text();
            $data[$key]['lit'] =  $coin->find('.lit > span')->text();
            $data[$key]['cap'] =  $coin->find('.cap > span')->text();
            $data[$key]['img_src'] =  substr($coin->find('.text-center > a > img')->attr('data-srcset'), 0, -3);
           
        }
        unset($data[0]);
        return $data;
    }
}
