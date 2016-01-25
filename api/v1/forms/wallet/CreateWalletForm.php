<?php

namespace api\v1\forms\wallet;

use api\v1\forms\ApiForm;
use api\v1\models\interfaces\IUser;
use api\v1\models\queries\GroupActiveQuery;
use api\v1\models\queries\UserActiveQuery;
use api\v1\models\User;
use api\v1\models\Wallet;
use api\v1\models\WalletAmount;

class CreateWalletForm extends ApiForm
{
    public $name;
    public $user_id;
    public $currency_id;
    public $amount;

    protected $_currency;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'userValidator'],

            ['currency_id', 'required'],
            ['currency_id', 'integer'],
            //['currency_id', 'currencyValidator'],

            ['amount', 'number'],
        ];
    }

    public function save()
    {
        if (!$this->validate())
            return false;

        $wallet = new Wallet();
        $wallet->name = $this->name;
        $wallet->setUser($this->_user);

        if ($wallet->save()) {
            return [
                'wallet' => $wallet
            ];
        }

        return false;
    }
}