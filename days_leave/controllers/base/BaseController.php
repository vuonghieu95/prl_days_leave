<?php

class BaseController
{
    protected $_messages = [];

    public $validator = null;

    /**
     * @return null
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param null $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function __construct()
    {

        include_once('helper/Helper.php');
        require_once(getRootPath('models/PostModel.php'));
        require_once(getRootPath('models/UsersModel.php'));
        require_once(getRootPath('models/TeamModel.php'));
        require_once(getRootPath('validation/validate.php'));
        $validator = new Validate();
        $this->setValidator($validator);
    }

    public function loadView($view)
    {
        list($controller, $action) = explode('.', $view);
        include_once(getRootPath('views/view_data.php'));
        include_once(getRootPath('views/' . $controller . '/' . $action . '.php'));
    }

    public function setViewData($name, $data = [])
    {
        if (empty($data)) {
            return;
        }
        $GLOBALS['viewData'][$name] = $data;
    }

    public function setMessage($message)
    {
        $this->_messages[] = $message;
    }

    public function getMessage()
    {
        return $this->_messages;
    }

    public function getSession($session)
    {
        return $_SESSION[$session];
    }

    public function setSession($session, $content)
    {
        return $_SESSION[$session] = $content;
    }

    public function redirect($params = [])
    {
        $link = http_build_query($params);
        header("location:index.php?" . $link);
    }

    public function getPost()
    {
        $postModel = new PostModel();
        $postModel->getData();
        return $postModel->getData();
    }

    public function getDataSelect()
    {
        $postModel = new PostModel();
        $postModel->getDataSelect();
        return $postModel->getDataSelect();
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
        return $postModel->getDataAll();
    }

    public function add(){}

    public function addTeamModel()
    {
        $name = $_POST['name'];
        $logo = ('/views/logo/' . $_FILES['logo']['name']);
        $description = $_POST['description'];
        $addTeamModel = new TeamModel();
        $param = [
            'name' => $name, 'logo' => $logo, 'description' => $description
        ];
        $addTeamModel->insert($param);
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
        if (!empty($_FILES['avatar']['name'])) {
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
        $editUsersModel = new UsersModel();
        $param = [
            'name' => $name, 'avatar' => $avatar, 'phone' => $phone, 'work_start_date' => $work_start, 'email' => $email, 'role_type' => $role_type, 'team_id' => $team,
            'position_id' => $position, 'id' => $id
        ];

        $editUsersModel->update($id, $param);
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $delUsersModel = new UsersModel();
        $delUsersModel->delete($id);
    }

    public function deleteDay()
    {
        $id = $_GET['id'];
        $delDateModel = new DateModel();
        $delDateModel->delete($id);
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

    public function addDaysLeaveAdmin()
    {
        if (empty($_SESSION['login'])) {
            echo "please login";
            exit();
        }
        $postModel = new PostModel();
        $name = $_POST['name'];
        $userID = $postModel->getUserID($name);
        $date_leave = date("Y-m-d H:i:s", strtotime($_POST['work_start_date']));
        if (empty($_POST['to_date'])) {

        } else {
            $to_date = date("Y-m-d H:i:s", strtotime($_POST['to_date']));
        }
        $note = $_POST['description'];
        $ins_id = $_SESSION['login']->id;
        $param = [
            'user_id' => $userID, 'date_leave' => $date_leave, 'to_date' => $to_date, 'note' => $note
        ];

        if (!$postModel->check($_SESSION['login']->id, $date_leave, $to_date)) {
            $addDateModel = new DateModel();
            $addDateModel->insert($param);
        } else {
            echo "Error <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit();
        }

    }
}