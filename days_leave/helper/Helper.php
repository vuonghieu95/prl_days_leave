<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 09:45
 */

$config = require_once ('../config/config3.php');

function getConfig($key, $default = null) {
    global $config;
    return isset($config[$key])?$config[$key]:$default;

}
