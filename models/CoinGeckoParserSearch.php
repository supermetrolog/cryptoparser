<?php

namespace app\models;

use yii\base\Model;

/**
 * Our data model extends yii\base\Model class so we can get easy to use and yet 
 * powerful Yii 2 validation mechanism.
 */
class CoinGeckoParserSearch extends Model
{
    /**
     * We plan to get two columns in our grid that can be filtered.
     * Add more if required. You don't have to add all of them.
     */
    public $name;
    public $price;
    private $data;
    /**
     * Here we can define validation rules for each filtered column.
     * See http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     * for more information about validation.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['price'], 'integer'],
            // our columns are just simple string, nothing fancy
        ];
    }

    /**
     * In this example we keep this special property to know if columns should be 
     * filtered or not. See search() method below.
     */
    private $_filtered = false;

    /**
     * This method returns ArrayDataProvider.
     * Filtered and sorted if required.
     */
    public function search($params)
    {
        /**
         * $params is the array of GET parameters passed in the actionExample().
         * These are being loaded and validated.
         * If validation is successful _filtered property is set to true to prepare
         * data source. If not - data source is displayed without any filtering.
         */
        if ($this->load($params) && $this->validate()) {
            $this->_filtered = true;
        }

        return new \yii\data\ArrayDataProvider([
            // ArrayDataProvider here takes the actual data source
            'allModels' => $this->getData(),
            'pagination' => [
                'pageSize' => 65,
            ],
            'sort' => [
                // we want our columns to be sortable:
                'attributes' => ['name', 'price'],
            ],
        ]);
    }

    /**
     * Here we are preparing the data source and applying the filters
     * if _filtered property is set to true.
     */
    protected function getData()
    {
        $data = $this->data;

        if ($this->_filtered) {
            $data = array_filter($data, function ($value) {
                $conditions = [true];
                if (!empty($this->name)) {
                    $conditions[] = strpos($value['name'], $this->name) !== false;
                }
                if (!empty($this->price)) {
                    $conditions[] = strpos($value['price'], $this->price) !== false;
                }
                return array_product($conditions);
            });
        }

        return $data;
    }
}