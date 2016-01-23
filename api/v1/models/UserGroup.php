<?php

namespace api\v1\models;

use api\v1\models\interfaces\IUserGroup;
use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 *
 * @property Group $group
 * @property User $user
 */
class UserGroup extends ApiActiveRecord implements IUserGroup
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'required'],
            [['user_id', 'group_id', 'created_at', 'updated_at', 'deleted'], 'integer']
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
            'group_id' => 'Group ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
