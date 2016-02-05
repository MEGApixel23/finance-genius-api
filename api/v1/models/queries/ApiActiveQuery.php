<?php

namespace api\v1\models\queries;

use yii\db\ActiveQuery;
use api\v1\models\interfaces\IUser;
use yii\helpers\ArrayHelper;

class ApiActiveQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['deleted' => false]);
    }

    /**
     * @param IUser $user
     * @return $this
     */
    public function forUsersInSameGroup(IUser $user)
    {
        return $this->andWhere(['user_id' => ArrayHelper::getColumn($user->getUsersFromGroup(), 'id')]);
    }

    /**
     * @param $data
     * @return $this
     */
    public function expand($data)
    {
        $model = new $this->modelClass();
        $expand = isset($data['expand']) ? $data['expand'] : [];
        $relations = explode(',', $expand);

        if ($relations) {
            $relations = array_intersect($model->extraFields(), $relations);
            sort($relations);

            $this->with($relations);
        }

        return $this;
    }
}