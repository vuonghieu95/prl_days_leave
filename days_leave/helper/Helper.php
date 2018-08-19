<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 09:45
 */

$config = require_once('../config/config.php');

function getConfig($key, $default = null)
{
    global $config;
    return isset($config[$key]) ? $config[$key] : $default;

}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$parse = parse_url($actual_link);
if (isset($parse['query'])) {
    parse_str($parse['query'], $query);
    unset($query['page']);
    $actual_link = $parse['scheme'] . '://' . $parse['host'] . $parse['path'] . '?' . http_build_query($query);
}
else {
    $actual_link = $parse['scheme'] . '://' . $parse['host'] . $parse['path'] . '?' ;
}
