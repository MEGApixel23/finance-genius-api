<?php

namespace api\v1\models;

use api\v1\models\interfaces\ITransaction;
use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $wallet_id
 * @property integer $currency_id
 * @property integer $category_id
 * @property integer $type
 * @property string $comment
 * @property string $amount
 * @property string $amount_before
 * @property string $amount_after
 * @property integer $done_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property Category $category
 * @property User $user
 * @property Wallet $wallet
 * @property Transfer[] $transfers
 * @property Transfer[] $transfers0
 */
class Transaction extends ApiActiveRecord implements ITransaction
{
    const TYPE_INCOME = 1;
    const TYPE_OUTCOME = 2;
    const TYPE_TRANSFER = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'wallet_id', 'currency_id', 'category_id', 'type', 'done_at'], 'required'],
            [['user_id', 'wallet_id', 'currency_id', 'category_id', 'type', 'done_at', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['amount', 'amount_before', 'amount_after'], 'number'],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'wallet_id' => 'Wallet ID',
            'currency_id' => 'Currency ID',
            'category_id' => 'Category ID',
            'type' => 'Type',
            'comment' => 'Comment',
            'amount' => 'Amount',
            'amount_before' => 'Amount Before',
            'amount_after' => 'Amount After',
            'done_at' => 'Done At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['id' => 'wallet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfers()
    {
        return $this->hasOne(Transfer::className(), ['income_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransfers0()
    {
        return $this->hasOne(Transfer::className(), ['outcome_transaction_id' => 'id']);
    }
}
