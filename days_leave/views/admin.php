<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 06/08/2018
 * Time: 18:14
 */
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}
?>

<?php
include_once ('header.php');
include_once ('sidenav.php');




