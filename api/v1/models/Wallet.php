<?php

namespace api\v1\models;

use api\v1\models\interfaces\IWallet;
use api\v1\models\queries\WalletActiveQuery;
use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property Transaction[] $transactions
 * @property User $user
 * @property WalletAmount[] $walletAmounts
 */
class Wallet extends ApiActiveRecord implements IWallet
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function extraFields()
    {
        return [
            'transactions', 'user', 'amounts'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['wallet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmounts()
    {
        return $this->hasMany(WalletAmount::className(), ['wallet_id' => 'id']);
    }

    /**
     * @return WalletActiveQuery
     */
    public static function find()
    {
        return new WalletActiveQuery(get_called_class());
    }
}
