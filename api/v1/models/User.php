<?php

namespace api\v1\models;

use api\v1\models\interfaces\IUser;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property UserGroup[] $userGroups
 */
class User extends ApiActiveRecord implements IUser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'deleted'], 'integer'],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['user_id' => 'id']);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $token
     * @return ActiveQuery|null
     */
    public static function findByToken($token)
    {
        $userQuery = null;
        $device = Device::find()->where(['token' => $token])->limit(1)->one();

        if ($device) {
            $userQuery = User::find()->andWhere(['id' => $device->user_id]);
        }

        return $userQuery;
    }
}
