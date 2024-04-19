<?php

include_once("PHP/Conn.php");


class Menu
{

    public $ID;
    public $Title;
    public $Description;
    public $Price;
    public $Image;
    public $Category;
    

    public static function GetMenusByCategory($category)
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT `id`, `Title`, `Description`, `Image`, `Price`, `Category` FROM `menu` WHERE `Category` = :category";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->execute();
            $menus = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $menu = new Menu();
                $menu->ID = $row['id'];
                $menu->Title = $row['Title'];
                $menu->Description = $row['Description'];
                $menu->Image = $row['Image'];
                $menu->Price = $row['Price'];
                $menu->Category = $row['Category'];
                $menus[] = $menu;
            }
            return $menus;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function SearchMenus($searchTerm)
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT `id`, `Title`, `Description`, `Image`, `Price`,`Category` FROM `menu` WHERE `Title` LIKE :searchTerm OR `Description` LIKE :searchTerm";
            $stmt = $conn->prepare($query);
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            $menus = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $menu = new Menu();
                $menu->ID = $row['id'];
                $menu->Title = $row['Title'];
                $menu->Description = $row['Description'];
                $menu->Image = $row['Image'];
                $menu->Price = $row['Price'];
                $menu->Category = $row['Category'];
                $menus[] = $menu;
            }
            return $menus;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function Add()
    {
        try {
            $query = "INSERT INTO `menu`(`Title`, `Description`,`Price`,`Category`) 
        VALUES(:Title,:Descri,:Price,:Category)";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
           
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            $st->bindValue(":Descri", $this->Description, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Category", $this->Category, PDO::PARAM_STR);
   
            $st->execute();
            return $conn->lastInsertId();

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function UpdateImage()
    {
        try {
            $query = "UPDATE `menu` SET `Image`=:Images WHERE id =:id";
            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":Images", $this->Image, PDO::PARAM_STR);
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetMenus()
    {
        try {
            $query = "SELECT `id`, `Title`, `Description`,`Image`,`Price`,`Category` FROM `menu`";

            $conn = Conn::GetConnection();
            $menus = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $menu = new Menu();

                $menu->ID = $row[0];
                $menu->Title = $row[1];
                $menu->Description = $row[2];
                $menu->Image = $row[3];
                $menu->Price = $row[4];
                $menu->Category = $row[5];
       

                array_push($menus, $menu);
            }
            return $menus;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function Update()
    {
        try {
            $query = "Update `menu` Set`Title`=:Title, `Description`=:Descri,`Price`=:Price,`Category`=:Category where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
            
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            $st->bindValue(":Descri", $this->Description, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Category", $this->Category, PDO::PARAM_STR);
           
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);
            $st->execute();
            

        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function Delete()
    {
        try {
            $query = "Delete from `menu` where id=:id";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);
           
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            $st->bindValue(":Descri", $this->Description, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Category", $this->Category, PDO::PARAM_STR);
            $st->bindValue(":id", $this->ID, PDO::PARAM_INT);

            $st->execute();
            
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public static function GetMenu($id)
    {
        try {
            $query = "SELECT `id`, `Title`, `Description`, `Image`,`Price`,`Category` FROM `menu` where id=".$id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
                $menu = new Menu();

                $menu->ID = $row[0][0];
                $menu->Title = $row[0][1];
                $menu->Description = $row[0][2];
                $menu->Image = $row[0][3];
                $menu->Price = $row[0][4];
                $menu->Category = $row[0][5];
            
               
               
            return $menu;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetMenuCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM menu"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }




}
