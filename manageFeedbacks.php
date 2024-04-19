<?php
include("PHP/feedback.php");

$feedbacks = FeedBack::GetFeedBack();

if (isset($_POST["btnDelete"])) {
    $feedBacksToDelete = new FeedBack();
    $feedBacksToDelete->ID = $_POST["offerID"];

    try {
        $feedBacksToDelete->Delete();
        echo "Feedback deleted successfully.";
       
    } catch (Exception $ex) {
        echo "Error deleting feedback: " . $ex->getMessage();
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
            <h1 style="text-align: center;">View FeedBack</h1>
            <form method="post" enctype="multipart/form-data">
                <?php
                if (sizeof($feedbacks) > 0) {
                    echo '<table>';
                    echo '<tr>
                            <td>Feedback Details</td>
                            <td>Actions</td>
                          </tr>';

                    foreach ($feedbacks as $feedback) {
                        echo '<tr>
                                <td>ID: ' . $feedback->ID . '<br>
                                    Star Count: ' . $feedback->Rating . '<br>
                                    Opinon: ' . $feedback->Opinion . '<br>
        
                                </td>
                                <td>
                                    <input type="hidden" name="reservationID" value="' . $feedback->ID . '">
                                    <button type="submit" name="btnDelete" value="' . $feedback->ID . '">Delete</button>
                                </td>
                              </tr>';
                    }

                    echo '</table>';
                } else {
                    echo "No Feedbacks Info Found";
                }
                ?>
            </form>
        </aside>
    </main>
    <!-- Footer content -->
</body>

</html>
