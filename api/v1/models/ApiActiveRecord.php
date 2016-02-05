<?php

namespace api\v1\models;

use api\v1\models\interfaces\IApiActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use api\v1\models\interfaces\IUser;

class ApiActiveRecord extends ActiveRecord implements IApiActiveRecord
{
    const ERROR_VALIDATION = 'VALIDATION_ERROR';

    public function load($data, $formName = null)
    {
        return parent::load($data, '');
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            TimestampBehavior::className()
        ]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser(IUser $user)
    {
        $this->user_id = $user->getid();
    }
}