<?php

namespace api\v1\models\interfaces;

interface IApiActiveRecord
{
    public function getId();
    public function load($data, $formName = null);
}