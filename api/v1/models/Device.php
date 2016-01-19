<?php

namespace api\v1\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property integer $token_expires_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token_expires_at'], 'required'],
            [['user_id', 'token_expires_at', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['token'], 'string', 'max' => 255],
            [['token'], 'unique']
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
            'token' => 'Token',
            'token_expires_at' => 'Token Expires At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    public function generateToken()
    {
        $this->token = (string) time();
        $this->token_expires_at = time() + 10000;
        return $this->token;
    }
}