<?php

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "outerclovedb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $opinion = $_POST['opinion'];

   
    $rating = mysqli_real_escape_string($conn, $rating);
    $opinion = mysqli_real_escape_string($conn, $opinion);

   
    $sql = "INSERT INTO feedback (rating_stars, opinion) VALUES ('$rating', '$opinion')";

    if ($conn->query($sql) === TRUE) {
        $response = array(
            "status" => "success",
            "message" => "Feedback submitted successfully"
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "error",
            "message" => "Error: " . $sql . "<br>" . $conn->error
        );
        echo json_encode($response);
    }
}

$conn->close();
?>
