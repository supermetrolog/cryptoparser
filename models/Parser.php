<?php

namespace app\models;
use yii\base\Model;

class Parser extends Model
{
    private $coinGeckoContent;
    private const COIN_GECKO_URL = 'https://www.coingecko.com/en';
    private function Request ($url, $postdata = null){


		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0');

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);

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
}
