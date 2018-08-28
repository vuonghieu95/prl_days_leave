<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 09:37
 */
return [
    'team' => [
        'Vinh' => 1,
        'Hoang' => 2,
        'Hung' => 3,
        'Tuan' => 4
    ],
    'role_type' => [
        'Member' => 1,
        'Leader' => 2,
        'Admin' => 3
    ],
    'position' => [
        'Member' => 1,
        'Leader' => 2,
        'Manager' => 3
    ],
    'env' => [
        'host' => 'localhost',
        'dbname' => 'days_leave',
        'username' => 'root',
        'password' => ''
    ],
    'actual_link' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
    'del_flag_on' => 1, 'del_flag_off' => 0, 'display' => 5
];