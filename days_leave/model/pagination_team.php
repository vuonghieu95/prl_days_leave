<?php

$conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
$display = 5;
$team = isset($_GET['team']) ? $_GET['team'] : '';
if (isset($_GET['key'])) {
    $search = $_GET['key'];
}else {
    $search = '';
}
$result= $conn->query( "Select users.id as total from users left join teams on users.team_id = teams.id where users.del_flag =0 
                                  and teams.id =$team and (users.name LIKE '%$search%' || users.email Like '%$search%' || users.phone LIKE '%$search%' )
                                  order by users.id DESC ");
$total_rows = $result->rowCount();
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = (($curr_page - 1) * $display);
$total_pages = ceil($total_rows /5);
$start = 1;
$end = $total_pages;
//return $position;
?>
