<?php

namespace api\v1\models;

use api\v1\models\interfaces\IClient;
use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $token_expires_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property User $user
 */
class Client extends ApiActiveRecord implements IClient
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'deleted'], 'integer'],
            [['token', 'token_expires_at'], 'string', 'max' => 255],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function generateToken()
    {
        $this->token = (string) time();
        $this->token_expires_at = time() + 10000;

        return $this->token;
    }
}
