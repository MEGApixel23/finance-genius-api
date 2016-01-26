<?php

namespace api\v1\models;

use api\v1\models\interfaces\ICurrency;
use api\v1\models\queries\CurrencyActiveQuery;
use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $sign
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property User $user
 * @property WalletAmount[] $walletAmounts
 */
class Currency extends ApiActiveRecord implements ICurrency
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['name', 'sign'], 'string', 'max' => 255]
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
            'sign' => 'Sign',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
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
    public function getWalletAmounts()
    {
        return $this->hasMany(WalletAmount::className(), ['currency_id' => 'id']);
    }

    /**
     * @return CurrencyActiveQuery
     */
    public static function find()
    {
        return new CurrencyActiveQuery(get_called_class());
    }
}
