<?php

namespace api\v1\models;

use api\v1\models\interfaces\IUser;
use api\v1\models\queries\UserActiveQuery;
use Yii;
use api\v1\models\queries\GroupActiveQuery;
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
 * @property Category[] $categories
 * @property Client[] $clients
 * @property Currency[] $currencies
 * @property Transaction[] $transactions
 * @property UserGroup[] $userGroups
 * @property Wallet[] $wallets
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
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasMany(Currency::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id'])
            ->via('userGroups');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallets()
    {
        return $this->hasMany(Wallet::className(), ['user_id' => 'id']);
    }

    public function setPassword($password)
    {
        $this->password_hash = md5($password);
    }

    public function validatePassword($password)
    {
        return $this->password_hash === md5($password);
    }

    public function isInSameGroup(IUser $user)
    {
        $users = $this->getUsersFromGroup();
        $validated = call_user_func(function($users, $user) {
            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]->id == $user->id)
                    return true;
            }

            return false;
        }, $users, $this);

        return $validated;
    }

    public function getUsersFromGroup()
    {
        $group = $this->getGroup()->one();
        $users = $group ? $group->getUsers()->all() : [];

        return array_merge($users, [$this]);
    }

    /**
     * @return UserActiveQuery
     */
    public static function find()
    {
        return new UserActiveQuery(get_called_class());
    }
}
