<?php

namespace api\v1\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
class Transaction extends ApiActiveRecord
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
     * @return array
     */
    public function behaviors()
    {
        return array_merge([
            TimestampBehavior::className(),
        ], parent::behaviors());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'wallet_id'], 'required'],

            [['amount'], 'required'],

            [['type'], 'required'],
            [['type'], 'integer'],
            [['type'], 'in', 'range' => [
                static::TYPE_INCOME, self::TYPE_OUTCOME, self::TYPE_TRANSFER
            ]],

            [['wallet_id'], 'integer'],
            [['wallet_id'], 'walletValidator'],

            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['category_id'], 'categoriesValidator'],

            [['user_id', 'type', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['amount_before', 'amount_after', 'amount'], 'number'],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['id' => 'wallet_id']);
    }

    public function walletValidator($attr)
    {
        $wallet = Wallet::find()->where(['id' => $this->$attr])->limit(1)->one();

        if (!$wallet) {
            $this->addError($attr, 'There is no such wallet');
            return false;
        }

        if ($wallet->user_id != $this->user_id) {
            $this->addError($attr, "This wallet isn't your's");
            return false;
        }

        return true;
    }

    public function categoriesValidator($attr)
    {
        $category = Category::find()->where(['id' => $this->$attr])->limit(1)->one();

        if (!$category) {
            $this->addError($attr, 'There is no such category');
            return false;
        }

        if ($category->user_id != $this->user_id) {
            $this->addError($attr, "This category isn't your's");
            return false;
        }

        return true;
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

    public function beforeSave($insert)
    {
        if ($insert) {
            $wallet = $this->getWallet()->one();
            if (!$wallet)
                return false;

            /* @var $wallet \api\v1\models\Wallet */

            $this->amount_before = $wallet->amount;
            $this->amount_after = $this->calculateAmountAfter();

            $wallet->amount = $this->amount_after;

            if (!$wallet->save())
                return false;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return float
     */
    public function calculateAmountAfter()
    {
        if ($this->type == static::TYPE_INCOME) {
            return (float) $this->amount_before + (float) $this->amount;
        } elseif ($this->type == static::TYPE_OUTCOME) {
            return (float) $this->amount_before - (float) $this->amount;
        } elseif ($this->type == static::TYPE_TRANSFER) {
            return (float) $this->amount_before - (float) $this->amount;
        }

        return 0.0;
    }
}