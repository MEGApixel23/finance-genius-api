<?php

namespace api\v1\forms;

use api\v1\models\Device;
use api\v1\models\queries\DeviceActiveQuery;
use api\v1\models\queries\UserActiveQuery;
use yii\base\Model;

class AuthForm extends Model
{
    public $email;
    public $password;

    protected $_user;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],

            ['password', 'required'],
            ['password', 'string'],
            ['password', 'userValidator'],
        ];
    }

    public function userValidator($attr)
    {
        if (!$this->hasErrors()) {
            $user = UserActiveQuery::findActive()->andWhere(['email' => $this->email])->limit(1)->one();

            if (!$user || !$user->validatePassword($this->$attr)) {
                $this->addError($attr, 'Wrong auth data.');
                return false;
            }

            $this->_user = $user;
            return true;
        }
    }

    public function auth()
    {
        $device = DeviceActiveQuery::findActive()->andWhere([
            'user_id' => $this->_user->id
        ])->limit(1)->one();

        return [
            'user' => $this->_user,
            'device' => $device
        ];
    }
}