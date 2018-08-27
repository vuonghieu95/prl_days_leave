<?php
$conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
$display = 5;
if (isset($_GET['key'])) {
    $search = $_GET['key'];
} elseif (isset($_GET['manager'])) {
    $search = 'manager';
} elseif (isset($_GET['leader'])) {
    $search = 'leader';
} elseif (isset($_GET['member'])) {
    $search = 'member';
} else {
    $search = '';
}
$result= $conn->query( "Select users.id as total from users left join teams on users.team_id = teams.id left join positions on users.position_id = positions.id where users.del_flag =0 
                                  and (users.name LIKE '%$search%' || users.email Like '%$search%' || users.phone LIKE '%$search%' || positions.name LIKE '%$search%')
                                  order by users.id DESC ");
$total_rows = $result->rowCount();
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = (($curr_page - 1) * $display);
$total_pages = ceil($total_rows /5);
$start = 1;
$end = $total_pages;
//return $position;
?>
