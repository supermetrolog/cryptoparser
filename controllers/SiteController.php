<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Parser;
use app\models\CoinGeckoParserSearch;
use yii\data\ArrayDataProvider;
class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new Parser();
        $data = $model->parseCoinGecko()->getCoinGeckoContent();
        $searchModel = new CoinGeckoParserSearch($data);
        $provider = $searchModel->search(Yii::$app->request->get());
        return $this->render('index', ['provider' => $provider, 'filter' => $searchModel]);
    }
    public function actionCryptoRank()
    {
        $model = new Parser();
        $data = $model->parseCryptoRank()->getCryptoRankContent();
        // echo '<pre>';
        // print_r($data);
         $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('cryptorank', ['provider' => $provider]);
    }

}
