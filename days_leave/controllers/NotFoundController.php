<?php
/**
 *
 */
include_once(getRootPath('controllers/BaseController.php'));

class NotFoundController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
//        require_once(getRootPath('model/DateModel.php'));
    }

    public function index()
    {
        echo'not found';die();
        $this->loadView('admin.no');
    }

}