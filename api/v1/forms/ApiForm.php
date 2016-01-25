<?php

namespace api\v1\forms;

use yii\base\Model;

class ApiForm extends Model
{
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
}