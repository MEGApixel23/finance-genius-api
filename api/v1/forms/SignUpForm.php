<?php

namespace api\v1\forms;

use api\v1\models\Client;
use api\v1\models\Device;
use api\v1\models\User;
use yii\base\Model;

class SignUpForm extends ApiForm
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

    public function signUp()
    {
        if (!$this->validate())
            return false;

        $user = new User();

        $user->email = $this->email;
        $user->setPassword($this->password);

        if (!$user->save())
            return false;

        $client = new Client();
        $client->setUser($user);
        $client->generateToken();

        if (!$client->save()) {
            print_r($client); die();
            return false;
        }

        return ['user' => $user, 'client' => $client];
    }
}