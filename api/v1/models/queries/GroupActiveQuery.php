<?php

namespace api\v1\models\queries;

use api\v1\models\interfaces\IUser;
use api\v1\models\User;
use api\v1\models\UserGroup;
use yii\db\ActiveQuery;

class GroupActiveQuery extends ActiveQuery
{
    /**
     * @param IUser $user
     * @return User[]|null
     */
    public static function findUsersInGroup(IUser $user)
    {
        $group = $user->getGroup()->one();

        if (!$group)
            return null;

        /* @var $group \api\v1\models\Group */

        return $group->getUsers()->all();
    }
}