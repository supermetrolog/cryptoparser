<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Parser;
use yii\data\ArrayDataProvider;
class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new Parser();
        $data = $model->parseCoinGecko()->getCoinGeckoContent();
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 65,
            ],
            'sort' => [
                'attributes' => ['price_int'],
            ],
        ]);
        $coins = $provider->getModels();
        // echo "<pre>";
        // print_r($data);
        // var_dump($content);
        return $this->render('index', ['coins' => $coins]);
    }
    public function actionCryptoRank()
    {
        $model = new Parser();
        $data = $model->parseCoinGecko()->getCoinGeckoContent();
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 65,
            ],
            'sort' => [
                'attributes' => ['price_int'],
            ],
        ]);
        $coins = $provider->getModels();
        // echo "<pre>";
        // print_r($data);
        // var_dump($content);
        return $this->render('cryptorank', ['coins' => $coins]);
    }

}
