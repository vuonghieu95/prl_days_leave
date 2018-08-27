<?php

$conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
$display = 5;
$result= $conn->query( "Select days_leave.id as total from days_leave where days_leave.del_flag =0 order by days_leave.id DESC ");
$total_rows = $result->rowCount();
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = (($curr_page - 1) * $display);
$total_pages = ceil($total_rows /5);
$start = 1;
$end = $total_pages;
//return $position;
?>
