<?php

/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 06/08/2018
 * Time: 14:41
 */

require_once('../model/PostModel.php');

class PostController
{
    public function getPost()
    {

        $postModel = new PostModel();
        $postModel->getData();
        return $postModel->getData();
    }

    public function addUser()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        $phone = $_POST['phone'];
        $roletype = $_POST['roletype'];
        $team = $_POST['team'];
        $position = $_POST['position'];
        $postModel = new PostModel();
        $postModel->add($name, $password, $email, $avatar, $phone, $roletype, $team, $position);
    }

    public function addTeam()
    {
        $name = $_POST['name'];
        $logo = ('/views/logo/' . $_FILES['logo']['name']);
        $description = $_POST['description'];
        $postModel = new PostModel();
        $postModel->addTeam($name, $logo, $description);
    }

    public function getResults()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $postModel = new PostModel();
        $data = $postModel->getResults($id);
        return $data;
    }

    public function editController()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        $phone = $_POST['phone'];
        $roletype = $_POST['roletype'];
        $team = $_POST['team'];
        $position = $_POST['position'];
        $postModel = new PostModel();
        $postModel->edit($id, $name, $password, $email, $avatar, $phone, $roletype, $team, $position);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $postModel = new PostModel();
        $postModel->delete($id);
    }

}