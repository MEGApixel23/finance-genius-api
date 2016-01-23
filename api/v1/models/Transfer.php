<?php

namespace api\v1\models;

use api\v1\models\interfaces\ITransfer;
use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property integer $id
 * @property integer $outcome_transaction_id
 * @property integer $income_transaction_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property Transaction $incomeTransaction
 * @property Transaction $outcomeTransaction
 */
class Transfer extends ApiActiveRecord implements ITransfer
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outcome_transaction_id', 'income_transaction_id'], 'required'],
            [['outcome_transaction_id', 'income_transaction_id', 'created_at', 'updated_at', 'deleted'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'outcome_transaction_id' => 'Outcome Transaction ID',
            'income_transaction_id' => 'Income Transaction ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'income_transaction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutcomeTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'outcome_transaction_id']);
    }
}
