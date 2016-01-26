<?php

namespace api\v1\forms;

use api\v1\models\queries\ClientActiveQuery;
use api\v1\models\User;
use Yii;
use api\v1\models\queries\UserActiveQuery;
use api\v1\models\Client;

class AuthForm extends ApiForm
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

    public function userValidator()
    {
        if (!$this->hasErrors()) {
            $user = User::find()->active()->andWhere([
                'email' => $this->email
            ])->limit(1)->one();

            /* @var $user \api\v1\models\User */

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Wrong auth data.');
                return false;
            }

            $this->_user = $user;
            return true;
        }
    }

    public function auth()
    {
        if (!$this->validate())
            return false;

        $client = new Client();
        $client->setUser($this->_user);
        $client->generateToken();

        if (!$client->save()) {
            $this->addError('password', 'Could not create Client');
            return false;
        }

        return [
            'user' => $this->_user,
            'client' => $client
        ];
    }
}