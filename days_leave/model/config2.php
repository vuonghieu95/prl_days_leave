<?php

$conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");

$display = 5; // so hang hien thi tren 1 trang
//$num_links = 5;
$result = $conn->query('Select * from users JOIN days_leave on users.id = days_leave.user_id WHERE users.del_flag=0 ');
$total_rows = $result->rowCount();

$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;

$position = (($curr_page - 1) * $display);
$total_pages = ceil($total_rows / 5);
$start = 1;
$end = $total_pages;
return $position;

?>



