<?php

namespace api\v1\forms;

use api\v1\models\interfaces\IUser;
use yii\base\Model;
use api\v1\models\queries\UserActiveQuery;
use api\v1\models\queries\GroupActiveQuery;

class ApiForm extends Model
{
    protected $_user;
    protected $_creatorUser;

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)
    {
        $formName = $formName === null ? '' : $formName;

        return parent::load($data, $formName);
    }

    public function setUser(IUser $user)
    {
        $this->_user = $user;
    }

    public function setCreatorUser(IUser $user)
    {
        $this->_creatorUser = $user;
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
}