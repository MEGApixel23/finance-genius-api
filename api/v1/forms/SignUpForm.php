<?php

namespace api\v1\forms;

use api\v1\models\Device;
use api\v1\models\User;
use yii\base\Model;

class SignUpForm extends Model
{
    public $email;
    public $password;

    protected $_user;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className()],

            ['password', 'required'],
            ['password', 'string'],
        ];
    }

    public function emailValidator($attr, $params)
    {
        if (!$this->hasErrors($attr)) {
            $existedUser = User::find()->where([$attr => $this->$attr])->limit(1)->one();

            if ($existedUser) {
                $this->addError($attr, $params['message']);
                return false;
            }
        }
    }

    public function signUp()
    {
        $user = new User();

        $user->email = $this->email;
        $user->password_hash = $this->password;

        if (!$user->save())
            return false;

        $device = new Device();
        $device->user_id = $user->id;
        $device->generateToken();

        if (!$device->save()) {
            return false;
        }

        return ['user' => $user, 'device' => $device];
    }
}