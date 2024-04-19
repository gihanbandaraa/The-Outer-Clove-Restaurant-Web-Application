<?php

include_once("PHP/Conn.php");

class FeedBack

{
    public $ID;
    public $Rating;
    public $Opinion;




    public static function GetFeedBack()
    {
        try {
            $query = "SELECT `ID`,`rating_stars`,`opinion` FROM `feedback`";
            $conn = Conn::GetConnection();

            $feedbacks = array();
            $result = $conn->query($query);

            foreach ($result as $row) {

                $feedback = new FeedBack();

                $feedback->ID = $row[0];
                $feedback->Rating = $row[1];
                $feedback->Opinion = $row[2];
            
                array_push($feedbacks, $feedback);
            }
            return $feedbacks;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Delete()
    {
        try {
            $query = "DELETE FROM `feedback` WHERE `ID` = :ID";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":ID", $this->ID, PDO::PARAM_INT);
            $st->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function GetFeedbackCount()
    {
        try {
            $conn = Conn::GetConnection();
            $query = "SELECT COUNT(*) as count FROM feedback"; 
            $result = $conn->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            return $count;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
