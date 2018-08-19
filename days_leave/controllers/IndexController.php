<?php
include_once 'model/PostModel.php';
class IndexController
{
    public function home()
    {
        $postModel = new PostModel();
        $data = $postModel->getResults($_GET['id']);
        include_once 'views/home.php';
    }

    public function detail()
    {
        echo  1;
    }
}