<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 09:45
 */

$GLOBALS['config'] = require_once(getRootPath('config/config.php'));

function getConfig($key, $default = null)
{
    $config = $GLOBALS['config'];
    return isset($config[$key]) ? $config[$key] : $default;
}

function getActualLink()
{
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parse = parse_url($actual_link);
    if (isset($parse['query'])) {
        parse_str($parse['query'], $query);
        $tmpQuery = $query;
        unset($tmpQuery['page']);
        $actual_link = $parse['scheme'] . '://' . $parse['host'] . $parse['path'] . '?'.(empty($tmpQuery) ? '' : (http_build_query($tmpQuery)));
    } else {
        $actual_link = $parse['scheme'] . '://' . $parse['host'] . $parse['path'] . '?';
    }
    return $actual_link;
}

function getRootPath($path)
{
    if (empty($path)) {
        return dirname(__DIR__);
    }
    $path = strpos($path, '/') == 0 ? $path : (DIRECTORY_SEPARATOR . $path);
    return dirname(__DIR__) . $path;
}

function getRootUrl($url)
{
    if (empty($url)) {
        return $_SERVER['HTTP_HOST'];
    }
    $url = strpos($url, '/') == 0 ? $url : (DIRECTORY_SEPARATOR . $url);
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $url;
}

function getPublicUrl($url)
{
    if (empty($url)) {
        return getRootUrl('/public');
    }
    return getRootUrl('/public/' . $url);
}

function redirect($controller, $action, $param = [])
{
    header('location:' . url($controller, $action, $param));
}

function url($controller, $action, $param = [])
{
    return 'index.php?controller=' . $controller . '&action=' . $action . '&' . http_build_query($param);
}