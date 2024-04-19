<?php

include_once("PHP/Conn.php");

class Images

{
    public $ID;
    public $Title;
    public $Image;

    public function Add()
    {
        try {
            $query = "INSERT INTO `Gallery`(`Title`) 
        VALUES(:Title)";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
           
            $st->execute();
            return $conn->lastInsertId();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function AddImage()
    {
        try {
            $query = "UPDATE `Gallery` SET `Image`=:Images WHERE id =:id";
            $conn = Conn::GetConnection();
    
            $st = $conn->prepare($query);
    
            $imagePath = $this->Image; 
            $id = $this->ID;
    
            $st->bindValue(":Images", $imagePath, PDO::PARAM_STR);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();
    
            if ($st->rowCount() > 0) {
                echo "Image path updated successfully!";
            } else {
                echo "No rows were updated.";
            }
    
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    
    public static function GetImage()
    {
        try {
            $query = "SELECT `ID`, `Title`, `Image` FROM `Gallery`"; 
            $conn = Conn::GetConnection();
    
            $Images = array();
            $result = $conn->query($query);
    
            foreach ($result as $row) {
                $Image = new Images();
    
                $Image->ID = $row['ID']; 
                $Image->Title = $row['Title'];
                $Image->Image = $row['Image'];
                
                array_push($Images, $Image);
            }
            return $Images;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    

    public function Update()
    {
        try {
            $query = "Update `Gallery` Set`Title`=:Title where ID=:ID";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);         
           
            $st->execute();  

        } catch (Exception $ex) {
            throw $ex;
        }
    }

        
    public function Delete()
    {
        try {
            $query = "Delete from `Gallery` where ID=:ID";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            //$st->bindValue(":Title", $this->Title, PDO::PARAM_STR);         
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
            
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetImages($id)
    {
        try {
            $query = "SELECT  `ID`,`Title`,`Image`
            FROM `Gallery` where ID=".$id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
                $Image = new Images();

                $Image->ID = $row[0][0];
                $Image->Title = $row[0][1];
                $Image->Image = $row[0][2];
               
               
            return $Image;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetImageCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM gallery"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

?>