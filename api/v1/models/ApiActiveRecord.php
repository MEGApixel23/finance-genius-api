<?php

namespace api\v1\models;

use api\v1\models\interfaces\IApiActiveRecord;
use yii\db\ActiveRecord;
use api\v1\models\interfaces\IUser;

class ApiActiveRecord extends ActiveRecord implements IApiActiveRecord
{
    public function load($data, $formName = null)
    {
        return parent::load($data, '');
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