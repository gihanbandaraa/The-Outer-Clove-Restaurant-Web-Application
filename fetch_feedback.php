<?php

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "outerclovedb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT rating_stars, opinion FROM feedback";
$result = $conn->query($sql);

$feedbackData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}

// Return feedback data as JSON
header('Content-Type: application/json');
echo json_encode($feedbackData);
?>
