<?php

namespace api\v1\models;

use yii\db\ActiveRecord;
use api\v1\models\interfaces\IUser;

class ApiActiveRecord extends ActiveRecord
{
    public function load($data, $formName = null)
    {
        return parent::load($data, '');
    }

    public function setUser(IUser $user)
    {
        $this->user_id = $user->getid();
    }
}