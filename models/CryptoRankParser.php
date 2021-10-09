<?php

namespace app\models;
use yii\base\Model;
use yii\helpers\ArrayHelper;
class CryptoRankParser extends Model
{
    private $content;
    private $coins;
    private $tagList;
    public function __construct($coinsData, $tagList)
    {
        $coinsData = json_decode($coinsData, true);
        $this->coins = $coinsData['data'];
        $tagList =  json_decode($tagList, true);
        $this->tagList = ArrayHelper::index($tagList['data'], 'id');
    }

    public function getContent()
    {
        $this->content = $this->getCoinsData();
        return $this->content;
    }

    private function getCoinsData()
    {
        $data = [];
        foreach ($this->coins as $key => $coin) {
            $data[$key]['name']  = $coin['name'];
            $data[$key]['timestamp']  = time();
            $data[$key]['tags']  = $this->getCoinTags($coin);
        }
        return $data;
    }

    private function getCoinTags($coin)
    {
        if (!ArrayHelper::keyExists('tagIds', $coin)) {
            return null;
        }
        $tagIds = $coin['tagIds'];
        $coinTags = [];
        foreach ($tagIds as $key => $tagId) {
            $coinTags[] = $this->tagList[$tagId]['name'];
        }
        return $coinTags;
    }
}
