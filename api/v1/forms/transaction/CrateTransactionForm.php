<?php

namespace api\v1\forms\transaction;

use api\v1\forms\ApiForm;
use api\v1\models\Transaction;

class CrateTransactionForm extends ApiForm
{
    public $wallet_id;
    public $currency_id;
    public $type;
    public $comment;
    public $amount;
    public $done_at;

    public function rules()
    {
        return [
            ['wallet_id', 'required'],
            ['wallet_id', 'integer'],
            ['wallet_id', 'walletValidator'],

            ['currency_id', 'required'],
            ['currency_id', 'integer'],
            ['currency_id', 'currencyValidator'],

            ['type', 'required'],
            ['type', 'integer'],
            ['type', 'in', 'range' => [Transaction::TYPE_INCOME, Transaction::TYPE_OUTCOME, Transaction::TYPE_TRANSFER]],

            ['amount', 'required'],
            ['amount', 'number'],
        ];
    }
}