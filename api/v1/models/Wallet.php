<?php

namespace api\v1\models;

use api\v1\models\queries\WalletActiveQuery;
use Yii;
use api\v1\models\interfaces\IUser;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "wallet".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $amount
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 */
class Wallet extends ApiActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
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
            [['user_id'], 'required'],
            [['user_id'], 'integer'],

            [['amount'], 'number'],
            [['amount'], 'safe'],

            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],

            [['amount', 'name', 'deleted'], 'safe'],

            [['created_at', 'updated_at', 'deleted'], 'integer'],
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
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }
}