<?php

/**
 * Class BaseModel
 */
include_once(getRootPath('config/config.php'));

class BaseModel
{
    public $table;

    public function connect()
    {
        $conn = new PDO('mysql:host=' . getConfig('env')['host'] . ';dbname=' . getConfig('env')['dbname'] . '',
            getConfig('env')['username'], getConfig('env')['password']);
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
        $sql = "Update $this->table set $this->table.del_flag='" . getConfig('del_flag_on') . "', $this->table.upd_id = '" . $data['upd_id'] . "'
                where $this->table.id= $id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function pagination($sql)
    {
        $conn = $this->connect();
        $conn->exec("set names utf8");
        $display = getConfig('display');
        $result = $conn->query($sql);
        $total_rows = $result->rowCount();
        $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = (($curr_page - 1) * $display);
        $total_pages = ceil($total_rows / $display);
        $start = 1;
        $end = $total_pages;
    }

}