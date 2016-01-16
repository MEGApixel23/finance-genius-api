<?php

namespace v1\Codeception\Module;

class FunctionalHelper extends \Codeception\Module
{
    public function _beforeSuite($settings = array())
    {
        include __DIR__ . '/../functional/_bootstrap.php';
    }

    protected function _fixtures()
    {
        return [];
    }
}
