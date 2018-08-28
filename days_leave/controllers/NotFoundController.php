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
    }

    public function index()
    {
        echo'not found';
        $this->loadView('admin.no');
    }

}