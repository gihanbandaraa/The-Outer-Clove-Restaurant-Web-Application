<?php
include("PHP/reservation.php");

$reservations = Reservations::GetReservation();

if (isset($_POST["btnDelete"])) {
    $reservationToDelete = new Reservations();
    $reservationToDelete->ID = $_POST["offerID"];

    try {
        $reservationToDelete->Delete();
        echo "Reservation deleted successfully.";
       
    } catch (Exception $ex) {
        echo "Error deleting offer: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>

    <link rel="stylesheet" href="Css/admin.css">
</head>
<body>
    <main>
        <aside>
            <h1 style="text-align: center;">View Reservations</h1>
            <form method="post" enctype="multipart/form-data">
                <?php
                if (sizeof($reservations) > 0) {
                    echo '<table>';
                    echo '<tr>
                            <td>Reservation Details</td>
                            <td>Actions</td>
                          </tr>';

                    foreach ($reservations as $reservation) {
                        echo '<tr>
                                <td>ID: ' . $reservation->ID . '<br>
                                    Name: ' . $reservation->Name . '<br>
                                    Name: ' . $reservation->Email . '<br>
                                    Date: ' . $reservation->Reservation_Date . '<br>
                                    Time: ' . $reservation->Reservation_Time . '<br>
                                </td>
                                <td>
                                    <input type="hidden" name="reservationID" value="' . $reservation->ID . '">
                                    <button type="submit" name="btnDelete" value="' . $reservation->ID . '">Delete</button>
                                </td>
                              </tr>';
                    }

                    echo '</table>';
                } else {
                    echo "No Reservation Info Found";
                }
                ?>
            </form>
        </aside>
    </main>
    <!-- Footer content -->
</body>

</html>
