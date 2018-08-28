<?php
include_once (getRootPath('models/base/BaseModel.php'));
class UsersModel extends BaseModel
{
    public $table ='users';
    public function pagingUser(){
        if (isset($_GET['key'])) {
            $search = $_GET['key'];
        } elseif (isset($_GET['manager'])) {
            $search = 'manager';
        } elseif (isset($_GET['leader'])) {
            $search = 'leader';
        } elseif (isset($_GET['member'])) {
            $search = 'member';
        } else {
            $search = '';
        }
        $conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');

        $result= $conn->query( "Select users.id as total from users left join teams on users.team_id = teams.id 
                                left join positions on users.position_id = positions.id where users.del_flag =0 )
                                order by users.id DESC ");

        $this->pagination($result);
    }
}