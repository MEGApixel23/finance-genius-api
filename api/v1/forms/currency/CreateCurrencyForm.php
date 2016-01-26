<?php

namespace api\v1\forms\currency;

use api\v1\forms\ApiForm;
use api\v1\models\Currency;
use api\v1\models\interfaces\ICurrency;

class CreateCurrencyForm extends ApiForm
{
    public $name;
    public $sign;

    protected $_currency;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

            ['sign', 'string'],
        ];
    }

    public function save()
    {
        if (!$this->validate())
            return false;

        $currency = new Currency();

        $currency->name = $this->name;
        $currency->sign = $this->sign;
        $currency->setUser($this->_user);

        if ($currency->save()) {
            $this->_currency = $currency;
            return true;
        }

        return false;
    }

    /**
     * @return ICurrency|null
     */
    public function getCurrency()
    {
        return $this->_currency;
    }
}