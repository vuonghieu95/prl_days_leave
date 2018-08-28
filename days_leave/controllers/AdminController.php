<?php
require_once(getRootPath('controllers/base/BaseController.php'));

class AdminController extends BaseController
{
    public function index()
    {
        $data = $this->getPostAll();
        $this->setViewData('data', $data);
        $this->loadview('admin.index');
    }

    public function contentTeam()
    {
        $data = $this->getPost();
        $this->setViewData('data', $data);
        $this->loadView('admin.content_team');
    }

    public function addTeam()
    {
        if (isset($_POST['add_team'])) {
            $this->_addTeamProcess();
        }
        $this->loadView('admin.add_team');
    }

    public function addUser()
    {
        if (isset($_POST['add_user'])) {
            $this->_addUserProcess();
        }
        $this->loadView('user.add_user');
    }

    public function info()
    {
        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        $this->setViewData('data', $data);
        $this->loadView('user.info_user');
    }

    public function editUser($id = null)
    {
        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        $this->setViewData('data', $data);
        if (isset($_POST['edit_user'])) {
            $this->_editUserProcess();
        }
        $this->loadView('user.edit_user');
    }

    public function confirm()
    {

        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        if (isset($_POST['edit_user'])) {
            if ($this->_editUserProcess($data)) {
                header('');
                return;
            }
            $this->setViewData('errors', $this->getMessage());
            $data = $_POST['edit_user'];
        }
        $data = $_SESSION['edit'];
        $this->setViewData('data', $data);
        $this->loadView('user.confirm_edit');
    }

    public function delUser()
    {
        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        $this->delete();
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    protected function _addUserProcess()
    {
        $isAdd = false;
        if (!$this->getValidator()->validateName($_POST['name'])) {
            $msg = $this->getValidator()->getErrorMessages();
            $this->setViewData('errors', $msg);
            return;
        }
        if (!$this->getValidator()->validatePhone($_POST['phone'])) {
            $msg = $this->getValidator()->getErrorMessages();
            $this->setViewData('errors', $msg);
            return;
        }
        if (!$this->getValidator()->validatePhone($_POST['email'])) {
            $msg = $this->getValidator()->getErrorMessages();
            $this->setViewData('errors', $msg);
            return;
        }

        if (empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['name'])) {
            echo "thieu param";
            return;
        }
        if (isset($_SESSION['tmp_avatar'])) {
            $target_dir = "../../views/img/";
            $target_file = $target_dir . basename($_SESSION['tmp_avatar']);
            $filename = $tmpFilename = $_SESSION['tmp_avatar'];
        }
        if (isset($_FILES['avatar']['name'])) {
            if ($_FILES["avatar"]["type"] == "image/gif" || $_FILES["avatar"]["type"] == "image/jpeg" ||
                $_FILES["avatar"]["type"] == "image/jpg" || $_FILES["avatar"]["type"] == "image/png") {
                $target_dir = getRootPath('views/img');
                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                $tmpFilename = $_FILES["avatar"]["tmp_name"];
                $filename = $_FILES["avatar"]["name"];
            }
        }
        if (isset($tmpFilename) && isset($filename) && isset($target_file) && move_uploaded_file($tmpFilename, $target_file)) {
            $message = "The file " . basename($filename) . " has been uploaded.";
            $isAdd = true;
        }
        echo isset($message) ? $message : "Sorry, there was an error uploading your file.";
        if ($isAdd) {
            $this->add();
            return $this->redirect(['controller' => 'admin', 'action' => 'index']);
        }
        return;
    }
    public function add()
    {
        $avatar = '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = md5(isset($_POST['password']) ? $_POST['password'] : '');
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        } elseif (isset($_SESSION['tmp_avatar']) ? $_SESSION['tmp_avatar'] : '') {
            $avatar = ($_SESSION['tmp_avatar']);
        }
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $role_type = isset($_POST['role_type']) ? $_POST['role_type'] : '';
        $team = isset($_POST['team']) ? $_POST['team'] : '';
        $date = strtotime(isset($_POST['work_start_date']) ? $_POST['work_start_date'] : '');
        $work_start = date("Y-m-d H:i:s", $date);
        $position = isset($_POST['position']) ? $_POST['position'] : '';
        $addUsersModel = new UsersModel();
        $param = [
            'name' => $name, 'password' => $password, 'email' => $email, 'avatar' => $avatar, 'phone' => $phone,
            'role_type' => $role_type, 'team_id' => $team, 'work_start_date' => $work_start, 'position_id' => $position
        ];

        $addUsersModel->insert($param);
    }

    protected function _addTeamProcess()
    {
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $description = $_POST["description"];
        $ins_id = $_SESSION['login']->id;
        if (empty($name) || empty($description)) {
            echo "Please fill full info in this form . <a href='javascript: history.go(-1)'>Back</a>";
            exit;
        } else {
            $target_dir =getRootPath('views/logo');;

            $target_file = $target_dir . basename($_FILES["logo"]["name"]);

            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["logo"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            $this->addTeamModel();
            return $this->redirect(['controller' => 'admin', 'action' => 'index']);
        }
    }

    protected function _editUserProcess($data = [])
    {
        if (!$this->getValidator()->validateName($_POST['name'])) {
            $msg = $this->getValidator()->getErrorMessages();
            $this->setViewData('errors', $msg);
            return;
        }
        if (!$this->getValidator()->validatePhone($_POST['phone'])) {
            $msg = $this->getValidator()->getErrorMessages();
            $this->setViewData('errors', $msg);
            return;
        }

        if (empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['name'])) {
            $this->setMessage("thieu param");
            return;
        }
        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = $_POST["name"];
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = $_POST["phone"];
            if (!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{9})$/', $phone)) {
                $phoneErr = 'Please enter a valid phone number';
            }
        }
        $role_type = isset($_POST['role_type']) ? $_POST['role_type'] : '';
        $team = isset($_POST['team']) ? $_POST['team'] : '';
        $position = isset($_POST['position']) ? $_POST['position'] : '';
        if ($_FILES['avatar']['name'] != null) {
            $avatar = ('/views/img/' . $_FILES['avatar']['name']);
        } else {
            $avatar = $data['avatar'];
        }
        $_SESSION['edit'] = [
            'id' => $_POST['id'],
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'role_type' => $role_type,
            'team' => $team,
            'avatar' => $avatar,
            'position' => $position,
            'work_start_date' => $work_start_date = $_POST['work_start_date']
        ];
        $this->redirect(['controller' => 'admin', 'action' => 'confirm']);
        return true;
    }

    public function _confirmEditProcess()
    {
        $this ->edit($_SESSION['edit']['id']);
        return $this->redirect(['controller' => 'admin', 'action' => 'index']);
    }
}



