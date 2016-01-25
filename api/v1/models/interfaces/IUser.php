<?php

namespace api\v1\models\interfaces;

interface IUser extends IApiActiveRecord
{
    public function getGroup();
}