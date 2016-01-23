<?php

namespace api\v1\models;

use api\v1\models\interfaces\IWalletAmount;
use Yii;

/**
 * This is the model class for table "wallet_amount".
 *
 * @property integer $id
 * @property integer $wallet_id
 * @property integer $currency_id
 * @property string $amount
 * @property string $total_outcome
 * @property string $total_income
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property Currency $currency
 * @property Wallet $wallet
 */
class WalletAmount extends ApiActiveRecord implements IWalletAmount
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wallet_id', 'currency_id'], 'required'],
            [['wallet_id', 'currency_id', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['amount', 'total_outcome', 'total_income'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wallet_id' => 'Wallet ID',
            'currency_id' => 'Currency ID',
            'amount' => 'Amount',
            'total_outcome' => 'Total Outcome',
            'total_income' => 'Total Income',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['id' => 'wallet_id']);
    }
}
