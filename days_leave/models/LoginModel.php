<?php
include_once(getRootPath('models/base/BaseModel.php'));

class LoginModel extends BaseModel
{
    public function checkLogin()
    {
        $conn = $this->connect();
        try {
            $sql = "Select * from users where email = :email and password = :password  and users.del_flag='".getConfig('del_flag_off')."' ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute(array(':email' => $_REQUEST['email'], ':password' => $_REQUEST['password']));
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

}