<?php

$_SERVER['SCRIPT_NAME'] = '/../index-test.php';
new \yii\console\Application(require(dirname(__DIR__) . '/../config/unit.php'));
