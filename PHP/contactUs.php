<?php

include_once("Conn.php");

class Contact

{
    public $ID;
    public $Name;
    public $Email;
    public $Message;
    public $Status;

    public function Add()
    {
        try {
            $query = "INSERT INTO `contact_us`(`Name`, `Email`, `Message`,`Status`) 
        VALUES(:Names,:Email,:Message,:Status)";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);

            $st->bindValue(":Names", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":Email", $this->Email, PDO::PARAM_STR);
            $st->bindValue(":Message", $this->Message, PDO::PARAM_STR);
            $st->bindValue(":Status", $this->Status, PDO::PARAM_STR);

            $st->execute();

            return $conn->lastInsertId();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetContacts()
    {
        try {
            $query = "SELECT `id`, `Name`, `Email`,`Message`,`Status` FROM `contact_us`";

            $conn = Conn::GetConnection();
            $contacts = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $contact = new Contact();

                $contact->ID = $row[0];
                $contact->Name = $row[1];
                $contact->Email= $row[2];
                $contact->Message = $row[3];
                $contact->Status = $row[4];



                array_push($contacts, $contact);
            }
            return $contacts;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Update()
    {
        try {
            $query = "Update `contact_us` Set`Name`=:Name,`Email`=:Email,`Message`=:Message,`Status`=:Status where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);

            $st->bindValue(":Name", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":Email", $this->Email, PDO::PARAM_STR);
            $st->bindValue(":Message", $this->Message, PDO::PARAM_STR);
            $st->bindValue(":Status", $this->Status, PDO::PARAM_STR);
          


            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);
            $st->execute();

        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function UpdateStatus()
    {
        try {
            $query = "UPDATE `contact_us` SET `Status`='Read' WHERE id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);


            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Delete()
    {
        try {
            $query = "Delete from `contact_us` where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);

            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public static function GetContact($id)
    {
        try {
            $query = "SELECT `id`, `Name`, `Email`, `Message`,`Status` FROM `contact_us` where id=" . $id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
            $contact = new Contact();

            $contact->ID = $row[0][0];
            $contact->Name = $row[0][1];
            $contact->Email = $row[0][2];
            $contact->Message = $row[0][3];
            $contact->Status = $row[0][4];


            return $contact;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetContactCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM contact_us Where Status='Read'";
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetPendingCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM contact_us Where Status='Pending'";
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
