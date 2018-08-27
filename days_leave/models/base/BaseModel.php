<?php

/**
 * Class BaseModel
 */

class BaseModel
{
    public $table;

    public function connect()
    {
        $host = getConfig('env')['host'];
        $dbname = getConfig('env')['dbname'];
        $username = getConfig('env')['username'];
        $password = getConfig('env')['password'];
        $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function insert($data)
    {
        $data['ins_id'] = $_SESSION['login']->id;
        $sql = "INSERT INTO $this->table";
        $alias = [];
        foreach ($data as $key => $value) {
            $aliasKey = ":$key";
            $alias[$aliasKey] = $value;
        }
        $sql .= ' (' . implode(',', array_keys($data)) . ') values(' . implode(',', array_keys($alias)) . ')';
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($alias);
    }

    public function update($id, $data)
    {
        $data['upd_id'] = $_SESSION['login']->id;
        $sql = "Update $this->table set ";
        $alias = [];
        foreach ($data as $key => $value) {
            $aliasKey = ":$key";
            $alias[$aliasKey] = $value;
        }
        $key_data = array_keys($data);
        $value_data = array_keys($alias);
        $new_array = array_combine($key_data, $value_data);
        foreach ($new_array as $k => $v) {
            $sql .= $k . ' = ' . $v . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= ' where id = :id';
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $data['upd_id'] = $_SESSION['login']->id;
        $sql = "Update $this->table set $this->table.del_flag=1, $this->table.upd_id = '" . $data['upd_id'] . "'
                where $this->table.id= $id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function pagination()
    {
        $conn = $this->connect();
        $conn->exec("set names utf8");
        $display = 5;
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
        $result = $conn->query("Select users.id as total from users left join teams on users.team_id = teams.id left join positions on users.position_id = positions.id where users.del_flag =0 
                                  and (users.name LIKE '%$search%' || users.email Like '%$search%' || users.phone LIKE '%$search%' || positions.name LIKE '%$search%')
                                  order by users.id DESC ");
        $total_rows = $result->rowCount();
        $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = (($curr_page - 1) * $display);
        $total_pages = ceil($total_rows / 5);
        $start = 1;
        $end = $total_pages;
    }

}