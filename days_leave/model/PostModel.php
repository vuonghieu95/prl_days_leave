<?php

/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 06/08/2018
 * Time: 14:41
 */
class PostModel
{
    public function connect()
    {
        $conn = new PDO('mysql:host=localhost;dbname=days_leave', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function getDataAll()

    {
        include 'config.php';
        $conn = $this->connect();
        $search = isset($_GET['key']) ? $_GET['key'] : '';
        $sql = "Select users.*,positions.name as position from users left join positions on users.position_id = positions.id
                left join teams on users.team_id = teams.id  where users.del_flag =0 and (users.name LIKE '%$search%' || users.phone LIKE '%$search%' || positions.name LIKE '%$search%') 
                 order by id DESC  LIMIT $position, $display";
        $data = $conn->query($sql);
        return $data;
    }

    public function getData()
    {
        $conn = $this->connect();
        $teamId = isset($_GET['team']) ? $_GET['team'] : '';
        $sql = "SELECT teams.*,users.*, positions.name as position FROM `users` left JOIN `positions` on users.position_id = positions.id 
                left join teams on users.team_id = teams.id where users.del_flag =0 and users.team_id = $teamId ";
        $data = $conn->query($sql);
        return $data;
    }

    public function getTeam()
    {
        $conn = $this->connect();
        $sql = "Select * from teams";
        $team = $conn->query($sql);
        return $team;
    }

    public function add($name, $password, $email, $avatar, $phone, $work_start, $roletype, $team, $position)
    {
        $conn = $this->connect();
        $sql = "INSERT INTO `users`(name, password, email, avatar, phone,role_type,work_start_date, team_id, position_id) 
                VALUE ('" . $name . "','" . $password . "','" . $email . "','" . $avatar . "',
           '" . $phone . "','" . $roletype . "','" . $work_start . "','" . $team . "','" . $position . "')";
        $conn->exec($sql);
    }

    public function addTeam($name, $logo, $description)
    {
        $conn = $this->connect();
        $sql = "INSERT INTO `teams`(name, logo, description) VALUE ('" . $name . "','" . $logo . "','" . $description . "')";
        $conn->exec($sql);
    }


    public function getResults($id)
    {
        $conn = $this->connect();
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $sql = "SELECT * FROM users where id ='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function edit($id, $name, $email, $avatar, $phone, $work_start, $roletype, $team, $position)
    {
        $conn = $this->connect();
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $sql = "UPDATE `users` SET  name ='" . $name . "',avatar='" . $avatar . "',
                phone='" . $phone . "',work_start_date='" . $work_start . "',email='" . $email . "',role_type='" . $roletype . "', team_id = '" . $team . "', 
                position_id = '" . $position . "' WHERE id =$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function delete($id)
    {
        $conn = $this->connect();
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $sql = "UPDATE `users` SET del_flag =1 where id =$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }


    public function getDays()
    {
        include 'config2.php';
        $conn = $this->connect();
        $search = isset($_GET['key']) ? $_GET['key'] : '';
        $sql = "Select * from users JOIN days_leave on users.id = days_leave.user_id 
                WHERE users.del_flag=0  and (users.name LIKE '%$search%' || users.phone LIKE '%$search%') 
                ORDER BY days_leave.id DESC  LIMIT $position, $display  ";
        $data = $conn->query($sql);
        return $data;
    }

    public function getUserID($userName)
    {
        $conn = $this->connect();

        $query = $conn->prepare("SELECT id FROM users WHERE name = ?");
        $query->execute(array($userName));
        return $query->fetchColumn();

    }

    public function addDayLeave($name, $date_leave, $note)
    {
        $userID = $this->getUserID($name);
        $conn = $this->connect();
        $sql = "INSERT INTO days_leave(user_id,date_leave,note)VALUES($userID,'".$date_leave."', '" . $note . "')";
        $conn->exec($sql);
    }
}