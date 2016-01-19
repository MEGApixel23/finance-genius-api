<?php

namespace api\v1\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $wallet_id
 * @property integer $category_id
 * @property string $amount_before
 * @property string $amount_after
 * @property string $amount
 * @property string $comment
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 */
class Transaction extends \yii\db\ActiveRecord
{
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
            [['user_id', 'wallet_id'], 'required'],
            [['user_id', 'wallet_id', 'category_id', 'type', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['amount_before', 'amount_after', 'amount'], 'number'],
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
            'category_id' => 'Category ID',
            'amount_before' => 'Amount Before',
            'amount_after' => 'Amount After',
            'amount' => 'Amount',
            'comment' => 'Comment',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }
}