<?php

require_once('../model/PostModel.php');

class PostController
{
    public function getPost()
    {

        $postModel = new PostModel();

        $postModel->getData();
        return $postModel->getData();
    }

    public function getTeam()
    {
        $postModel = new PostModel();
        $postModel->getTeam();
        return $postModel->getTeam();
    }

    public function getPostAll()
    {

        $postModel = new PostModel();
        $postModel->getDataAll();
        return $postModel->getDataAll();
    }

    public function addUser()
    {
        $name = $_POST['name'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        $phone = $_POST['phone'];
        $roletype = $_POST['roletype'];
        $team = $_POST['team'];
        $date = strtotime($_POST['work_start_date']);
        $work_start = date("Y-m-d H:i:s", $date);
        $ins_id = $_SESSION['login']->id;
        $position = $_POST['position'];
        $postModel = new PostModel();
        $postModel->add($name, $password, $email, $avatar, $phone, $work_start, $roletype, $team, $position, $ins_id);
    }

    public function addTeam()
    {
        $name = $_POST['name'];
        $logo = ('/views/logo/' . $_FILES['logo']['name']);
        $description = $_POST['description'];
        $postModel = new PostModel();
        $postModel->addTeam($name, $logo, $description);
    }

    public function getResults($id)
    {
        // $id = isset($_GET['id']) ? $_GET['id'] : '';
        $postModel = new PostModel();
        $data = $postModel->getResults($id);
        return $data;
    }

    public function editController($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        if ($_FILES['avatar']['name']!= null) {
            $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        }else {
            $data = $this->getResults($id);
            $avatar =   $data['avatar'];
        }
        $phone = $_POST['phone'];
        $roletype = $_POST['roletype'];
        $team = $_POST['team'];
        $date = strtotime($_POST['work_start_date']);
        $work_start = date("Y-m-d H:i:s", $date);
        $position = $_POST['position'];
        $upd_id = $_SESSION['login']->id;
        $postModel = new PostModel();
        $postModel->edit($id, $name, $email, $avatar, $phone, $work_start, $roletype, $team, $position, $upd_id);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $postModel = new PostModel();
        $postModel->delete($id);
    }

    public function getDays_Leave()
    {
        $postModel = new PostModel();
        $postModel->getDays();
        return $postModel->getDays();
    }

    public function getUserID()
    {
        include_once('../tachchuoi/Message.php');
        $message = new Message();
        $x = $message->process();
        $userName = $x['sender'];
        $ngay = strtotime($x['date']);
        $date = date('Y-m-d', $ngay);
        //$date = DateTime::createFromFormat('Y-m-d',$ngay )->format('Y-m-d');

        $date = date_create($x['date']);
        $date = date_format($date, "Y-m-d");

        $reason = $x['reason'];
        $postModel = new PostModel();
        $postModel->addDayLeave($userName, $date, $reason);
    }

    public function addDays_leave()
    {
        if (empty($_SESSION['login'])) {
            echo "please login";
            exit();
        }
        $date_leave = date("Y-m-d H:i:s", strtotime($_POST['work_start_date']));
        $note = $_POST['description'];
        $ins_id = $_SESSION['login']->id;
        $postModel = new PostModel();
        if (!$postModel->check($_SESSION['login']->id, $date_leave)) {
            $postModel->addDayLeave($_SESSION['login']->name, $date_leave, $note, $ins_id);
        } else {
            echo "Error <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit();
        }

    }

    public function addDays_leave_admin()
    {
        if (empty($_SESSION['login'])) {
            echo "please login";
            exit();
        }
        $name = $_POST['name'];
        $date_leave = date("Y-m-d H:i:s", strtotime($_POST['work_start_date']));
        $note = $_POST['description'];
        $ins_id = $_SESSION['login']->id;
        $postModel = new PostModel();
        if (!$postModel->check($_SESSION['login']->id, $date_leave)) {
            $postModel->addDayLeave($name, $date_leave, $note, $ins_id);
        } else {
            echo "Error <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit();
        }

    }
}