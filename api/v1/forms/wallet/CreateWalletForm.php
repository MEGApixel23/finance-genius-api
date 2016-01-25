<?php

namespace api\v1\forms\wallet;

use api\v1\forms\ApiForm;
use api\v1\models\interfaces\IUser;
use api\v1\models\queries\GroupActiveQuery;
use api\v1\models\queries\UserActiveQuery;
use api\v1\models\User;

class CreateWalletForm extends ApiForm
{
    public $name;
    public $user_id;
    public $currency_id;
    public $amount;

    protected $_currency;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'userValidator'],

            ['currency_id', 'required'],
            ['currency_id', 'integer'],
            //['currency_id', 'currencyValidator'],

            ['amount', 'number'],
        ];
    }

    public function userValidator($attr)
    {
        if (!$this->hasErrors($attr)) {
            $user = UserActiveQuery::findActive()->andWhere(['id' => $this->user_id])->one();

            if (!$user) {
                $this->addError($attr, 'There is no such User');
                return false;
            }

            /* @var $user IUser */

            $this->setUser($user);

            if ($this->$attr == $this->_creatorUser->id)
                return true;

            $users = GroupActiveQuery::findUsersInGroup($this->_creatorUser);
            $validated = call_user_func(function($users, $user) {
                for ($i = 0; $i < count($users); $i++) {
                    if ($users[$i]->id == $user->id)
                        return true;
                }

                return false;
            }, $users, $this->_user);

            if (!$validated) {
                $this->addError($attr, 'User Id is forbidden');
                return false;
            }
        }
    }

    public function save()
    {
        if (!$this->validate())
            return false;

        return false;
    }
}