<?php

include_once("Conn.php");

class CheckOut

{
    public $ID;
    public $Name;
    public $Price;
    public $Phone;
    public $Address;
    public $Details;
    public $Status;

    public function Add()
    {
        try {
            $query = "INSERT INTO `orders`(`Name`, `Price`, `Phone`,`Address`,`Details`,`Status`) 
        VALUES(:Names,:Price,:Phone,:Addresses,:Details,:Status)";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            
            $st->bindValue(":Names", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Phone", $this->Phone, PDO::PARAM_INT);
            $st->bindValue(":Addresses", $this->Address, PDO::PARAM_STR);
            $st->bindValue(":Details", $this->Details, PDO::PARAM_STR);
            $st->bindValue(":Status", $this->Status, PDO::PARAM_STR);

            $st->execute();
            
            return $conn->lastInsertId();
        } catch (Exception $ex) { 
            throw $ex;
        }
    }


    public static function GetOrders()
    {
        try {
            $query = "SELECT `id`, `Name`, `Price`,`Phone`,
             `Address`,`Details`,`Status` FROM `orders`";

            $conn = Conn::GetConnection();
            $orders = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $order = new CheckOut();

                $order->ID = $row[0];
                $order->Name = $row[1];
                $order->Price = $row[2];
                $order->Phone = $row[3];
                $order->Address = $row[4];
                $order->Details = unserialize($row[5]);
                $order->Status = $row[6];
             
       

                array_push($orders, $order);
            }
            return $orders;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function Update()
    {
        try {
            $query = "Update `orders` Set`Name`=:Name,`Price`=:Price,`Phone`=:Phone, `Address`=:Address,`Details`=:Details where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            
            $st->bindValue(":Name", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Phone", $this->Phone, PDO::PARAM_STR);
            $st->bindValue(":Address", $this->Address, PDO::PARAM_STR);
            $st->bindValue(":Details", $this->Details, PDO::PARAM_STR);

           
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);
            $st->execute();
            

        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function UpdateStatus()
    {
        try {
            $query = "UPDATE `orders` SET `Status`='Completed' WHERE id=:id";
    
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
            $query = "Delete from `orders` where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
           
            // $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            // $st->bindValue(":Descri", $this->Description, PDO::PARAM_STR);
            // $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);

            $st->execute();
            
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public static function GetOrder($id)
    {
        try {
            $query = "SELECT `id`, `Name`, `Price`, `Phone`,`Address`,`Details` FROM `orders` where id=".$id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
                $order = new CheckOut();

                $order->ID = $row[0][0];
                $order->Name = $row[0][1];
                $order->Price = $row[0][2];
                $order->Phone = $row[0][3];
                $order->Address = $row[0][4];
                $order->Details = $row[0][5];
            
               
               
            return $order;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetOrderCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM orders Where Status='Completed'"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public static function GetOrderPendingCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM orders Where Status='Pending'"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

  ?>  