<?php

namespace api\v1\forms;

use api\v1\models\interfaces\IUser;
use yii\base\Model;
use api\v1\models\queries\UserActiveQuery;
use api\v1\models\queries\GroupActiveQuery;

class ApiForm extends Model
{
    protected $_user;

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
}