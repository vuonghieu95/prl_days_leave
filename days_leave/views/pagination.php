<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> <?php include('css/pagination.css') ?></style>
</head>
<body>
<div class="pagination" style="text-align: center">


    <ul>
        <?php include_once('../helper/Helper.php');  ?>
        <?php if (isset($total_pages)) : ?>
            <?php if ($total_pages > 1) : ?>

                <li class="single " style="list-style-type: none; display: inline-block" >
                    Page <?php echo $curr_page . ' of ' . $total_pages ?></li> .</br>

                <?php if ($curr_page > 5) : ?>

                    <li   style="list-style-type: none; display: inline-block"><a
                                href=" <?php echo $actual_link . '&page=1'  ?>">First</a></li>
                <?php endif; ?>

                <?php if ($curr_page > 1) : ?>

                    <li  style="list-style-type: none; display: inline-block"><a
                                href="<?php echo $actual_link . '&page=' . ($curr_page - 1) ?>">< </a></li>
                <?php endif; ?>

                <?php for ($pages = $start; $pages <= $end; $pages++) : ?>
                    <?php if ($pages == $curr_page) : ?>
                        <li class="active" style="list-style-type: none; display: inline-block"><a
                                    href=" <?php echo $actual_link . '&page=' . $pages ?>"><?php echo $pages ?></a></li>
                    <?php else : ?>
                        <li  style="list-style-type: none; display: inline-block"><a
                                    href="<?php echo $actual_link . '&page=' . $pages ?>"><?php echo $pages ?></a></li>
                    <?php endif ?>
                <?php endfor ?>

                <?php if ($curr_page < $total_pages) : ?>
                    <!-- print 'Next'-->
                    <li style="list-style-type: none; display: inline-block"><a
                                href="<?php echo $actual_link . '&page=' . ($curr_page + 1) ?>">> </a></li>
                <?php endif; ?>

                <?php if (($curr_page + 5) < $total_pages) : ?>
                    <!-- print 'Last'-->
                <?php endif; ?>
            <?php endif; ?>
        <?php endif ?>
    </ul>
</div>
</body>
</html>
