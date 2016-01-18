<?php

namespace api\v1\forms;

use yii\base\Model;

class AuthForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string'],
        ];
    }

    public function auth()
    {

    }
}