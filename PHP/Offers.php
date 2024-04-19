<?php

include("Conn.php");

class Offers

{
    public $ID;
    public $Title;
    public $Price;
    public $Percentage;
    public $Image;

    public function Add()
    {
        try {
            $query = "INSERT INTO `offers`(`Title`, `Price`, `Percentage`) 
        VALUES(:Title,:Price,:Percentages)";

            $conn = Conn::GetConnection();

            $st = $conn->prepare($query);

            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Percentages", $this->Percentage, PDO::PARAM_INT);

            $st->execute();
            return $conn->lastInsertId();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function UpdateImage()
    {
        try {
            $query = "UPDATE `offers` SET `Image`=:Images WHERE id =:id";
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

    public static function GetOffer()
    {
        try {
            $query = "SELECT `ID`,`Title`,`Price`, `Percentage`, `Image` FROM `offers`";
            $conn = Conn::GetConnection();

            $offers = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $offer = new Offers();

                $offer->ID = $row[0];
                $offer->Title = $row[1];
                $offer->Price = $row[2];
                $offer->Percentage = $row[3];
                $offer->Image = $row[4];

                array_push($offers, $offer);
            }
            return $offers;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Update()
    {
        try {
            $query = "UPDATE `offers` SET `Title` = :Title, `Price` = :Price, `Percentage` = :Percentage WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":Title", $this->Title, PDO::PARAM_STR);
            $st->bindValue(":Price", $this->Price, PDO::PARAM_INT);
            $st->bindValue(":Percentage", $this->Percentage, PDO::PARAM_INT);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Delete()
    {
        try {
            $query = "DELETE FROM `offers` WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetOffers($id)
    {
        try {
            $query = "SELECT `ID`, `Title`, `Price`, `Percentage`, `Image`
            FROM `offers` where ID=" . $id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
            $offer = new Offers();

            $offer->ID = $row[0][0];
            $offer->Title = $row[0][1];
            $offer->Price = $row[0][2];
            $offer->Percentage = $row[0][3];
            $offer->Image = $row[0][4];


            return $offer;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetOfferCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM offers"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
