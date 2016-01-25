<?php

namespace api\v1\forms;

use api\v1\models\Client;
use Yii;
use api\v1\models\User;
use yii\base\ErrorException;

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

    /**
     * @return array|bool
     * @throws \yii\db\Exception
     */
    public function signUp()
    {
        if (!$this->validate())
            return false;

        $dbTransaction = Yii::$app->db->beginTransaction();

        try {
            $user = new User();

            $user->email = $this->email;
            $user->setPassword($this->password);

            if (!$user->save())
                throw new ErrorException('Could not create User');

            $client = new Client();
            $client->setUser($user);
            $client->generateToken();

            if (!$client->save())
                throw new ErrorException('Could not create Client');

        } catch (ErrorException $e) {
            $dbTransaction->rollBack();
            return false;
        }

        $dbTransaction->commit();
        return [
            'user' => $user,
            'client' => $client
        ];
    }
}