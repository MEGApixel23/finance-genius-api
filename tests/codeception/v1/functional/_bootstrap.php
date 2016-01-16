<?php
require_once(dirname(__DIR__) . '/_bootstrap.php');
$config = require( __DIR__ . '/../../config/functional.php');

new \yii\console\Application($config);