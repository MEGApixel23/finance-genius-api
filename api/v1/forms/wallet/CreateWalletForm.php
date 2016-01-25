<?php

namespace api\v1\forms\wallet;

use api\v1\forms\ApiForm;
use api\v1\models\Currency;
use api\v1\models\queries\CurrencyActiveQuery;
use api\v1\models\Wallet;
use api\v1\models\WalletAmount;

class CreateWalletForm extends ApiForm
{
    public $name;
    public $currency_id;
    public $amount;

    protected $_currency;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

            ['currency_id', 'required'],
            ['currency_id', 'integer'],
            ['currency_id', 'currencyValidator'],

            ['amount', 'number'],
        ];
    }

    public function currencyValidator($attr)
    {
        if (!$this->hasErrors($attr)) {
            $this->_currency = CurrencyActiveQuery::findActive()->andWhere(['id' => $this->$attr])->limit(1)->one();

            if (!$this->_currency) {
                $this->addError($attr, 'There is no such currency');
                return false;
            }

            $user = $this->_currency->user;
            if (!$user) {
                $this->addError($attr, 'There is no such currency');
                return false;
            }

            if (!$this->_user->isInSameGroup($user)) {
                $this->addError($attr, 'This currency belongs to another User');
                return false;
            }
        }
    }

    public function save()
    {
        if (!$this->validate())
            return false;

        $wallet = new Wallet();
        $wallet->name = $this->name;
        $wallet->setUser($this->_user);

        if ($wallet->save()) {
            $walletAmount = new WalletAmount();

            $walletAmount->wallet_id = $wallet->id;
            $walletAmount->currency_id = $this->_currency->id;
            $walletAmount->amount = (float) $this->amount;

            if ($walletAmount->save()) {
                return [
                    'wallet' => $wallet
                ];
            }
        }

        return false;
    }
}