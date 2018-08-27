<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> <?php include(getRootPath('css/pagination.css')) ?></style>
</head>
<body>
<div class="pagination" style="text-align: center; margin-left: 350px">
<?php getRootPath('helper/Helper.php') ?>
    <ul>
        <?php if (isset($data['total_pages'])) : ?>
            <?php if ($data['total_pages'] > 1) : ?>

                <li class="single " style="list-style-type: none; display: inline-block" >
                    Page <?php echo $data['curr_page'] . ' of ' . $data['total_pages'] ?></li> .</br>

                <?php if ($data['curr_page'] > 5) : ?>

                    <li   style="list-style-type: none; display: inline-block"><a
                                href=" <?php echo $actual_link . '&page=1'  ?>">First</a></li>
                <?php endif; ?>

                <?php if ($data['curr_page'] > 1) : ?>

                    <li  style="list-style-type: none; display: inline-block"><a
                                href="<?php echo $actual_link . '&page=' . ($data['curr_page'] - 1) ?>">< </a></li>
                <?php endif; ?>

                <?php for ($pages = $data['start']; $pages <= $data['end']; $pages++) : ?>
                    <?php if ($pages == $data['curr_page']) : ?>
                        <li class="active" style="list-style-type: none; display: inline-block"><a
                                    href=" <?php echo $actual_link . '&page=' . $pages ?>"><?php echo $pages ?></a></li>
                    <?php else : ?>
                        <li  style="list-style-type: none; display: inline-block"><a
                                    href="<?php echo $actual_link . '&page=' . $pages ?>"><?php echo $pages ?></a></li>
                    <?php endif ?>
                <?php endfor ?>

                <?php if ($data['curr_page'] < $data['total_pages']) : ?>
                    <!-- print 'Next'-->
                    <li style="list-style-type: none; display: inline-block"><a
                                href="<?php echo $actual_link . '&page=' . ($data['curr_page'] + 1) ?>">> </a></li>
                <?php endif; ?>

                <?php if (($data['curr_page'] + 5) < $data['total_pages']) : ?>
                    <!-- print 'Last'-->
                <?php endif; ?>
            <?php endif; ?>
        <?php endif ?>
    </ul>
</div>
</body>
</html>
