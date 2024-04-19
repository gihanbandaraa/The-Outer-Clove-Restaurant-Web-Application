<?php
include("PHP/contactUs.php");

if (isset($_POST["btnEdit"])) {
    $myContact = Contact::GetContact($_POST["btnEdit"]);

    if ($myContact) {
        $myContact->UpdateStatus();
?>

        <div class="success-message">
            Message View successfully.
        </div>
    <?php
    } else {

        echo "Message not found.";
    }
}

if (isset($_POST["btnDelete"])) {
    $messageToDelete = new Contact();
    $messageToDelete->ID = $_POST["offerID"];

    try {
        $messageToDelete->Delete();
    ?>

        <div class="success-message">
            Message deleted successfully.
        </div>
<?php
    } catch (Exception $ex) {

        echo "Error deleting Message: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="Css/admin.css">

    <style>
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .status-completed {
            color: green;
        }

        .status-pending {
            color: red;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main>
        <aside>
            <h1 style="text-align: center;">View Messages</h1>
            <form method="post" enctype="multipart/form-data">
                <?php
                $contacts = Contact::GetContacts();

                if (sizeof($contacts) > 0) {
                    echo '<table>';
                    echo '<tr>
                            <td>Basic Details</td>
                            <td>Complete | Close</td>
                          </tr>';

                    foreach ($contacts as $contact) {
                        $statusClass = ($contact->Status === 'Completed') ? 'status-completed' : 'status-pending';
                        echo '<tr>
                                <td>ID: ' . $contact->ID . '<br>
                                    Name: ' . $contact->Name . '<br>
                                    Email: ' . $contact->Email . '<br>
                                    Details:<br>' . $contact->Message . '<br>
                                    Status: <span class="' . $statusClass . '">' . $contact->Status . '</span>
                                </td>
                                <td>
                                    <input type="hidden" name="offerID" value="' . $contact->ID . '">
                                    <button type="submit" name="btnEdit" value="' . $contact->ID . '" style="background-color: #4CAF50;"><i class="fa-solid fa-check"></i></button>
                                    <button type="submit" name="btnDelete" value="' . $contact->ID . '"><i class="fa-solid fa-xmark"></i></button>
                                </td>
                              </tr>';
                    }

                    echo '</table>';
                } else {
                    echo "No Offer Info Found";
                }
                ?>
            </form>
        </aside>
    </main>
</body>

<button></button>

<footer>
    <p>&copy;2022 Web Devolopment</p>
</footer>
</body>

</html>