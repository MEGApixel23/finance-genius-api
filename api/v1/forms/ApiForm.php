<?php

namespace api\v1\forms;

use yii\base\Model;

class ApiForm extends Model
{
    public function load($data, $formName = null)
    {
        return parent::load($data, $formName ? $formName : '');
    }
}