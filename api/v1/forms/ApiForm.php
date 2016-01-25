<?php

namespace api\v1\forms;

use api\v1\models\interfaces\IUser;
use yii\base\Model;

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
}