<?php
include_once(getRootPath('controllers/base/BaseController.php'));
include_once(getRootPath('models/LoginModel.php'));

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadView('login.login');
        return;
    }

    public function login()
    {
        if (!isset($_POST['btn_submit'])) {
            return $this->redirect(['controller' => 'login', 'action' => 'index']);
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $postModel = new LoginModel();
        $result = $postModel->checkLogin();
        if ($result) {
            if ($_SESSION['login'] = $result) {
                return $this->redirect(['controller' => 'admin', 'action' => 'index']);
            }
        } else {
            return $this->redirect(['controller' => 'login', 'action' => 'index']);
        }
    }

    public function logout()
    {
        session_destroy();
        return $this->redirect(['controller' => 'login', 'action' => 'index']);
    }
}