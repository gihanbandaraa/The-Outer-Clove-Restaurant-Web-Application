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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO reservation (name, email, reservation_date, reservation_time)
            VALUES ('$name', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the original page after successful submission
        header('Location: index.php?reservation=success');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
