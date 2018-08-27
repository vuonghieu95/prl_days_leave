<?php
include_once (getRootPath('models/base/BaseModel.php'));

class PostModel extends BaseModel
{
    public function getDataAll()
    {
        $baseModel = new BaseModel();
        $conn = $baseModel->connect();
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
        $display = 5;
        $result = $conn->query("Select id as total from users where users.del_flag =0  order by id DESC ");
        $total_rows = $result->rowCount();
        $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = (($curr_page - 1) * $display);
        $total_pages = ceil($total_rows / 5);
        $start = 1;
        $end = $total_pages;
        $sql = "Select users.*,positions.name as position from users left join positions on users.position_id = positions.id
                left join teams on users.team_id = teams.id  where users.del_flag =0 and (users.name LIKE '%$search%' || users.email Like '%$search%' || users.phone LIKE '%$search%' || positions.name LIKE '%$search%') 
                 order by id DESC limit $offset, $display";
        $data = $conn->query($sql);
        $data = $data->fetchAll();
        return [
            'total_pages' =>$total_pages,
            'data' =>$data,
            'curr_page' =>$curr_page,
            'start' =>$start,
            'end' =>$end
        ];
    }

    public function getData()
    {
        $team = isset($_GET['team']) ? $_GET['team'] : '';
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
        $conn = $this->connect();
        $display = 5;
        $result = $conn->query("Select users.id as total from users left join teams on users.team_id = teams.id where users.del_flag =0 and teams.id = $team order by users.id DESC ");
        $total_rows = $result->rowCount();
        $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = (($curr_page - 1) * $display);
        $total_pages = ceil($total_rows / 5);
        $start = 1;
        $end = $total_pages;
        $sql = "SELECT teams.*,users.*,positions.name as position FROM `users` left join positions on users.position_id = positions.id
                left join teams on users.team_id = teams.id where users.del_flag =0 and users.team_id = teams.id and users.team_id = $team
                and (users.name LIKE '%$search%' || users.email Like '%$search%' || users.phone LIKE '%$search%' || positions.name LIKE '%$search%')
                order by users.id DESC limit $offset, $display";
        $data = $conn->query($sql);
        $data = $data->fetchAll();
        return [
            'total_pages' =>$total_pages,
            'data' =>$data,
            'curr_page' =>$curr_page,
            'start' =>$start,
            'end' =>$end
        ];
    }

    public function getDataSelect()
    {

        $conn = $this->connect();
        $sql = "Select * from users where users.del_flag =0 order by id DESC ";
        $data = $conn->query($sql);
        return $data;
    }

    public function getTeam()
    {
        $conn = $this->connect();
        $sql = "Select * from teams";
        $team = $conn->prepare($sql);
        $team->execute();
        $team = $team->fetchAll(\PDO::FETCH_ASSOC);
        return $team;
    }

    public function getResults($id)
    {
        $conn = $this->connect();
        $sql = "SELECT users.*,teams.name  as team,positions.name as position FROM users join teams on users.team_id = teams.id 
                 join positions on users.position_id = positions.id where  users.del_flag =0 and users.id ='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDays()
    {
        $conn = $this->connect();
        $display = 5;
        $result = $conn->query("Select days_leave.id as total from days_leave where days_leave.del_flag =0 order by days_leave.id DESC  ");
        $total_rows = $result->rowCount();
        $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = (($curr_page - 1) * $display);
        $total_pages = ceil($total_rows / 5);
        $start = 1;
        $end = $total_pages;
        $search = isset($_GET['key']) ? $_GET['key'] : '';
        $sql = "SELECT * FROM users JOIN days_leave on days_leave.user_id = users.id
                WHERE  days_leave.del_flag =0  and (users.name LIKE '%$search%' || users.phone LIKE '%$search%') 
                ORDER BY days_leave.id DESC limit $offset, $display ";
        $stmt = $conn->query($sql);
        $data = $stmt->fetchAll();
        return [
            'total_pages' =>$total_pages,
            'data' =>$data,
            'curr_page' =>$curr_page,
            'start' =>$start,
            'end' =>$end
        ];
    }

    public function getUserID($userName)
    {
        $conn = $this->connect();

        $query = $conn->prepare("SELECT id FROM users WHERE name = ?");
        $query->execute(array($userName));
        return $query->fetchColumn();

    }

    public function check($user_id, $date_leave, $to_date)
    {
        $conn = $this->connect();
        $sql = "SELECT * from days_leave where '" . date('Y-m-d', strtotime($date_leave)) . "'= DATE_FORMAT(date_leave, '%Y-%M-%d')
                and '" . date('Y-m-d', strtotime($to_date)) . "'= DATE_FORMAT(to_date, '%Y-%M-%d')
                and days_leave.user_id ='$user_id'";
        $data = $conn->exec($sql);
        return !empty($data);
    }


}