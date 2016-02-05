<?php

namespace api\v1\models;

use api\v1\models\interfaces\ICategory;
use api\v1\models\queries\CategoryActiveQuery;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted
 * @property integer|null $category_id
 *
 * @property User $user
 * @property Transaction[] $transactions
 */
class Category extends ApiActiveRecord implements ICategory
{
    const TYPE_INCOME = 1;
    const TYPE_OUTCOME = 2;
    const TYPE_COMMON = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'deleted'], 'integer'],

            ['type', 'in', 'range' => [self::TYPE_INCOME, self::TYPE_OUTCOME, self::TYPE_COMMON]],

            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'name' => 'Name',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    public function extraFields()
    {
        return [
            'user', 'transactions'
        ];
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
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['category_id' => 'id']);
    }

    public static function find()
    {
        return new CategoryActiveQuery(get_called_class());
    }
}
