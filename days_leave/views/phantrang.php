<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> <?php include('css/phantrang.css') ?></style>
</head>
<body>
<div class="phantrang" align="center">

    <ul>
        <?php


        if (isset($total_pages)) {
            if ($total_pages > 1) // nếu tổng số trang > 1 in dòng Page..of..

            {
                echo '<li class="single" style="list-style-type: none; display: inline-block">Page ' . $curr_page . ' of ' . $total_pages . '</li>' . "</br>";
                // nếu trang hiện tại lớn hơn số link muốn hiển thị
                if ($curr_page > 5) {
                    // thì hiển thị nút 'First'
                    echo '<li style="list-style-type: none; display: inline-block"><a href="?page=1">First</a></li>';
                }
                // nếu trang hiện tại > 1
                if ($curr_page > 1) {
                    // hiển thị nút 'Previous'
                    echo '<li style="list-style-type: none; display: inline-block"><a href="?page=' . ($curr_page - 1) . '"><    </a> </li>';
                }
                // hiển thị các link bao gồm trang hiện tại và link trang hiển thị (trái và phải) bắt đầu từ $start, kết thúc là $end
                // $start và $end được tính trong pagination.php
                for ($pages = $start; $pages <= $end; $pages++) {
                    if ($pages == $curr_page) {
                        echo '<li  style="list-style-type: none; display: inline-block"><a href="?page=' . $pages . '">' . $pages . '</a></li>';
                    } else {
                        echo '<li style="list-style-type: none; display: inline-block"><a href="?page=' . $pages . '">' . $pages . '</a></li>';
                    }
                }
                // nếu trang hiện tại < tổng số trang
                if ($curr_page < $total_pages) {
                    // thì hiển thị nút 'Next'
                    echo '<li style="list-style-type: none; display: inline-block"><a href="?page=' . ($curr_page + 1) . '">></a></li>';
                }
                // nếu trang hiện tại + số link muốn hiển thị (ở đây là + với số link bên phải) > tổng số trang
                if (($curr_page + 5) < $total_pages) {
                    // thì hiển thị nút 'Last'
                    echo '<li style="list-style-type: none; display: inline-block" ><a href="?page=' . $total_pages . '">Last</a> </li>';
                }
            }
        }
        ?>
    </ul>
</div>
</body>
</html>
