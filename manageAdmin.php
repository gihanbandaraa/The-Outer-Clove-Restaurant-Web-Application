<?php
include("PHP/adminM.php");

$admins = Admins::GetAdmin();

if (isset($_POST["btnEdit"])) {
    $myAdmin = Admins::GetAdmins($_POST["btnEdit"]);
}

if (isset($_POST["btnDelete"])) {
    $AdminToDelete = new Admins();
    $AdminToDelete->ID = $_POST["offerID"];

    try {
        $AdminToDelete->Delete();
        echo "Admin deleted successfully.";
    } catch (Exception $ex) {
        echo "Error deleting Admin: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage</title>

    <link rel="stylesheet" href="Css/admin.css">
</head>

<body>
    <main>
        <aside id="offerAddSection">
            <h1 style="text-align: center;">Admin Update Form</h1>
            <form method="post" enctype="multipart/form-data">
                <ul>
                    <div class="textArea">
                        <li><input type="text" name="txtName" placeholder="Name" required value="<?php
                                                                                                    if (isset($myAdmin))
                                                                                                        echo $myAdmin->Name;
                                                                                                    ?>"></li>
                        <li><input type="text" name="txtEmail" placeholder="Email" required value="<?php
                                                                                                    if (isset($myAdmin))
                                                                                                        echo $myAdmin->Email;
                                                                                                    ?>"></li>
                        <li><input type="text" name="txtPassword" placeholder="Password" required value="<?php
                                                                                                            if (isset($myAdmin))
                                                                                                                echo $myAdmin->Password;
                                                                                                            ?>"></li>
                    </div>

                    <input type="submit" value="Update" name="btnUpdate">

                    </li>
                </ul>
            </form>
            <?php
            if (isset($_POST["btnUpdate"])) {
                $admin = new Admins;

                $admin->Name = $_POST["txtName"];
                $admin->Email = $_POST["txtEmail"];
                $admin->Password = $_POST["txtPassword"];


                try {

                    $admin->Update();
                    $id = $admin->ID;

                    echo '<p class="success-message" style="text-align: center;" >Admin Updated Successfully</p>';
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
            ?>

            <aside>
                <h1 style="text-align: center;">View Admins</h1>
                <form method="post" enctype="multipart/form-data">
                    <?php
                    if (sizeof($admins) > 0) {
                        echo '<table>';
                        echo '<tr>
                            <td>Admin Detail</td>
                            <td>Actions</td>
                          </tr>';

                        foreach ($admins as $admin) {
                            echo '<tr>
                                <td>ID: ' . $admin->ID . '<br>
                                    Name: ' . $admin->Name . '<br>
                                    Email: ' . $admin->Email . '<br>
                                    Password: ' . $admin->Password . '<br>
                                    User Type: ' . $admin->User_Type . '<br>
                                </td>
                                <td>
                                    <input type="hidden" name="reservationID" value="' . $admin->ID . '">
                                    <button type="submit" name="btnDelete" value="' . $admin->ID . '">Delete</button>
                                    <button type="submit" name="btnEdit" value="' . $admin->ID . '">Update</button>
                                   
                                </td>
                              </tr>';
                        }

                        echo '</table>';
                    } else {
                        echo "No Admins Info Found";
                    }
                    ?>
                </form>
            </aside>
    </main>
</body>

</html>