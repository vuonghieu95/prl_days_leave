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
        if (!empty( $_FILES['avatar']['name'])){
        $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        }elseif ($_SESSION['tmp_avatar']){
            $avatar = ($_SESSION['tmp_avatar']);
        }
        $phone = $_POST['phone'];
        $role_type = $_POST['role_type'];
        $team = $_POST['team'];
        $date = strtotime($_POST['work_start_date']);
        $work_start = date("Y-m-d H:i:s", $date);
        $ins_id = $_SESSION['login']->id;
        $position = $_POST['position'];
        $postModel = new PostModel();
        $param = [
            'name' => $name, 'password' => $password, 'email' => $email, 'avatar' => $avatar, 'phone' => $phone,
            'role_type' => $role_type, 'team' => $team, 'work_start' => $work_start, 'ins_id' => $ins_id, 'position' => $position
        ];
        $postModel->add($param);
    }

    public function addTeam()
    {
        $name = $_POST['name'];
        $logo = ('/views/logo/' . $_FILES['logo']['name']);
        $description = $_POST['description'];
        $param = [
            'name' => $name, 'logo' => $logo, 'description' => $description
        ];
        $postModel = new PostModel();
        $postModel->addTeam($param);
    }

    public function getResults($id)
    {
        $postModel = new PostModel();
        $data = $postModel->getResults($id);
        return $data;
    }

    public function edit($id)
    {
        $name = $_SESSION['edit']['name'];
        $email = $_SESSION['edit']['email'];
        if ($_FILES['avatar']['name'] != null) {
            $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        } else {
            $data = $this->getResults($id);
            $avatar = $_SESSION['edit']['avatar'];
        }
        $phone = $_SESSION['edit']['phone'];
        $role_type = $_SESSION['edit']['role_type'];
        $team = $_SESSION['edit']['team'];
        $date = strtotime($_SESSION['edit']['work_start_date']);
        $work_start = date("Y-m-d H:i:s", $date);
        $position = $_SESSION['edit']['position'];
        $upd_id = $_SESSION['login']->id;
        $param = [
             'name' => $name,'email'=>$email, 'avatar' => $avatar, 'phone' =>$phone, 'role_type' =>$role_type, 'team' =>$team,
            'work_start'=>$work_start,'position'=>$position,'upd_id' =>$upd_id
        ];
        $postModel = new PostModel();
        $postModel->edit($id,$param);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $postModel = new PostModel();
        $postModel->delete($id);
    }

    public function getDaysLeave()
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

    public function addDaysleave()
    {
        if (empty($_SESSION['login'])) {
            echo "please login";
            exit();
        }
        $date_leave = date("Y-m-d H:i:s", strtotime($_POST['work_start_date']));
        if (empty($_POST['to_date'])) {

        } else {
            $to_date = date("Y-m-d H:i:s", strtotime($_POST['to_date']));
        }
        $note = $_POST['description'];
        $ins_id = $_SESSION['login']->id;
        $postModel = new PostModel();
        if (!$postModel->check($_SESSION['login']->id, $date_leave, $to_date)) {
            $postModel->addDayLeave($_SESSION['login']->name, $date_leave, $to_date, $note, $ins_id);
        } else {
            echo "Error <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit();
        }

    }

    public function addDaysLeaveAdmin()
    {
        if (empty($_SESSION['login'])) {
            echo "please login";
            exit();
        }
        $name = $_POST['name'];
        $date_leave = date("Y-m-d H:i:s", strtotime($_POST['work_start_date']));
        if (empty($_POST['to_date'])) {

        } else {
            $to_date = date("Y-m-d H:i:s", strtotime($_POST['to_date']));
        }
        $note = $_POST['description'];
        $ins_id = $_SESSION['login']->id;
        $postModel = new PostModel();
        if (!$postModel->check($_SESSION['login']->id, $date_leave,$to_date)) {
            $postModel->addDayLeave($name, $date_leave,$to_date, $note, $ins_id);
        } else {
            echo "Error <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit();
        }

    }
}