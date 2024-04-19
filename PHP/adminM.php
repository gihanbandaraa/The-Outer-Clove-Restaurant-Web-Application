<?php

include_once("PHP/Conn.php");

class Admins

{
    public $ID;
    public $Name;
    public $Email;
    public $Password;
    public $User_Type;



    public static function GetAdmin()
    {
        try {
            $query = "SELECT `ID`, `name`, `email`, `password`,`user_type` FROM `user_form` WHERE `user_type` = 'admin'";

            $conn = Conn::GetConnection();

            $admins = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $admin = new Admins();

                $admin->ID = $row[0];
                $admin->Name = $row[1];
                $admin->Email = $row[2];
                $admin->Password = $row[3];
                $admin->User_Type= $row[4];

                array_push($admins, $admin);
            }
            return $admins;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Update()
    {
        try {
            $query = "UPDATE `user_form` SET `name` = :name, `email` = :email,
             `password` = :password,`user_type`=:user_type
             WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":name", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":email", $this->Email, PDO::PARAM_STR);
            $hashedPassword = md5($this->Password, PASSWORD_DEFAULT);
            $st->bindValue(":password",$hashedPassword, PDO::PARAM_STR);
            $st->bindValue(":user_type", $this->User_Type, PDO::PARAM_STR);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Delete()
    {
        try {
            $query = "DELETE FROM `user_form` WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetAdmins($id)
    {
        try {
            $query = "SELECT `ID`, `name`, `email`, `password`, `user_type`
            FROM `user_form` where ID=" . $id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
            $admin = new Admins();

            $admin->ID = $row[0][0];
            $admin->Name = $row[0][1];
            $admin->Email = $row[0][2];
            $admin->Password = $row[0][3];
            $admin->User_Type = $row[0][4];


            return $admin;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
