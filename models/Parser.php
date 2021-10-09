<?php

namespace app\models;
use yii\base\Model;

class Parser extends Model
{
    private $coinGeckoContent;
    private const COIN_GECKO_URL = 'https://www.coingecko.com/en';
	
    private $cryptoRankContent;
    private const CRYPTO_RANK_ALL_COINS_URL = 'http://api.cryptorank.io/v0/coins?locale=en';
    private const CRYPTO_RANK_TAGS_URL = 'http://api.cryptorank.io/v0/coin-tags';
    private function Request ($url, $postdata = null){


		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0');

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		//curl_setopt($ch, CURLOPT_PROXY, '85.10.219.102:1080');
		//curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($ch, CURLOPT_MAXCONNECTS, 1);

		if($postdata){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		}

		$html = curl_exec($ch);
		echo curl_error($ch);
		if (!$html) {
			return false;
		}
		curl_close($ch);
		return $html;
	}

    public function parseCoinGecko(Type $var = null)
    {
        
        $this->coinGeckoContent = (new CoinGeckoParser($this->Request(self::COIN_GECKO_URL)))->getContent(); 
        return $this;
    }

    public function getCoinGeckoContent()
    {
        return $this->coinGeckoContent;
    }
	public function parseCryptoRank(Type $var = null)
    {
        
        $this->cryptoRankContent = (new CryptoRankParser($this->Request(self::CRYPTO_RANK_ALL_COINS_URL), $this->Request(self::CRYPTO_RANK_TAGS_URL)))->getContent(); 
        return $this;
    }

    public function getCryptoRankContent()
    {
        return $this->cryptoRankContent;
    }
}
