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

    public function getData()
    {
        $conn = $this->connect();
        $teamId = isset($_GET['team']) ? $_GET['team'] : '';

        $sql = "SELECT teams.*,users.*, positions.name as position FROM `users` left JOIN `positions` on users.position_id = positions.id 
left join teams on users.team_id = teams.id where users.del_flag =0 and users.team_id = $teamId";
        $data = $conn->query($sql);
        return $data;
    }

    public function add($name, $password, $email, $avatar, $phone, $roletype, $team, $position)
    {
        $conn = $this->connect();
        $sql = "INSERT INTO `users`(name, password, email, avatar, phone,role_type, team_id, position_id) VALUE ('" . $name . "','" . $password . "','" . $email . "','" . $avatar . "',
        '" . $phone . "','" . $roletype . "','" . $team . "','" . $position . "')";
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

    public function edit($id, $name, $password, $email, $avatar, $phone, $roletype, $team, $position)
    {
        $conn = $this->connect();
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $sql = "UPDATE `users` SET  name ='" . $name . "',avatar='" . $avatar . "',password='" . $password . "',phone='" . $phone . "',email='" . $email . "',role_type='" . $roletype . "', team_id = '" . $team . "', position_id = '" . $position . "' WHERE id =$id";
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
}