<?php
include_once(getRootPath('controllers/base/BaseController.php'));

require_once(getRootPath('models/DateModel.php'));

require_once(getRootPath('models/TeamModel.php'));

class DaysLeaveController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->getDaysLeave();
        $this->setViewData('data', $data);
        $this->loadView('admin.days_leave');
    }

    public function addDaysLeave()
    {
        $data = $this->getDataSelect();
        $this->setViewData('data', $data);
        if (isset($_POST['add_days_leave'])) {
            $this->_addDaysLeaveProcess();
        }
        $this->loadView('date.add_days_leave');
    }

    public function deleteDaysLeave()
    {
        $data = $this->getResults(isset($_GET['id']) ? $_GET['id'] : '');
        $this->deleteDay();
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    protected function _addDaysLeaveProcess()
    {
        $name = $_POST['name'];
        $date_leave = $_POST['work_start_date'];
        $to_date = $_POST['to_date'];
        $note = $_POST['description'];
        if (empty($name) || empty($date_leave) || empty($note)) {
            echo "Please fill full info in this form . <a href='javascript: history.go(-1)'>Back</a>";
            exit;
        } else {

            $this->addDaysLeaveAdmin();
            return $this->redirect(['controller' => 'daysLeave', 'action' => 'index']);
        }
    }
}
