<?php

include_once("PHP/Conn.php");

class Reservations

{
    public $ID;
    public $Name;
    public $Email;
    public $Reservation_Date;
    public $Reservation_Time;



    public static function GetReservation()
    {
        try {
            $query = "SELECT `ID`,`name`,`email`, `reservation_date`, `reservation_time` FROM `reservation`";
            $conn = Conn::GetConnection();

            $reservations = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $reservation = new Reservations();

                $reservation->ID = $row[0];
                $reservation->Name = $row[1];
                $reservation->Email = $row[2];
                $reservation->Reservation_Date = $row[3];
                $reservation->Reservation_Time = $row[4];

                array_push($reservations, $reservation);
            }
            return $reservations;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Update()
    {
        try {
            $query = "UPDATE `reservation` SET `name` = :name, `email` = :email,
             `reservation_date` = :reservation_date,`reservation_time`=:reservation_time
             WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":name", $this->Name, PDO::PARAM_STR);
            $st->bindValue(":email", $this->Email, PDO::PARAM_STR);
            $st->bindValue(":reservation_date", $this->Reservation_Date, PDO::PARAM_STR);
            $st->bindValue(":reservation_time", $this->Reservation_Time, PDO::PARAM_STR);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Delete()
    {
        try {
            $query = "DELETE FROM `reservation` WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetReservations($id)
    {
        try {
            $query = "SELECT `ID`, `name`, `email`, `reservation_date`, `reservation_time`
            FROM `reservation` where ID=" . $id;
            $conn = Conn::GetConnection();
            $result = $conn->query($query);

            $row = $result->fetchAll();
            $reservation = new Reservations();

            $reservation->ID = $row[0][0];
            $reservation->Name = $row[0][1];
            $reservation->Email = $row[0][2];
            $reservation->Reservation_Date = $row[0][3];
            $reservation->Reservation_Time = $row[0][4];


            return $reservation;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function GetReservationCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM reservation"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
