<?php
include("PHP/Gallery.php");


if (isset($_POST["btnEdit"])) {
    $myOffer = Images::GetImages($_POST["btnEdit"]);
}

if (isset($_POST["btnDelete"])) {
    $offerToDelete = new Images();
    $offerToDelete->ID = $_POST["offerID"];

    try {
        $offerToDelete->Delete();
        echo "Image deleted successfully.";
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
    <title>Add Images</title>
    <link rel="stylesheet" href="Css/admin.css">
</head>

<body>

    <main>
        <aside>

            <h1 style="text-align: center;">Image Add Form</h1>
            <form method="post" enctype="multipart/form-data">
                <ul>

                    <div class="textArea">
                        <li><input type="text" name="txtImageTitle" placeholder="Enter Image Title" required value="<?php
                                                                                                                    if (isset($myGallery))
                                                                                                                        echo $myGallery->Title;
                                                                                                                    ?>"></li>

                        <li>Add Image to Gallery<input type="file" name="txtImage" style="margin-top: 10px;"><?php if (isset($myGallery))
                                                                                                                    echo '<img src ="' . $myGallery->Image . '" width = "150px" height="150px" >';
                                                                                                                ?></li>

                        <li>
                            <input type="submit" value="Add" name="btnImageAdd">
                            <input type="submit" value="Update" name="btnImageUpdate">
                            <input type="submit" value="Delete" name="btnDelete">
                        </li>
                </ul>
            </form>
            <?php

            if (isset($_POST["btnImageAdd"])) {

                $Gallery = new Images;
                $Gallery->Title = $_POST["txtImageTitle"];


                try {
                    $id = $Gallery->Add();

                    $Image = $_FILES["txtImage"]["name"];

                    $info = new SplFileInfo($Image);
                    $newName = "./Gallery/" . $id . "F." . $info->getExtension();

                    var_dump($newName);
                    move_uploaded_file($_FILES["txtImage"]["tmp_name"], $newName);

                    $Gallery->ID = $id;
                    $Gallery->Image = $newName;
                    $Gallery->AddImage();

                    echo '<br>' . "Image Added Successfully";
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            } elseif (isset($_POST["btnImageUpdate"])) {
                $Gallery = new Images;


                $Gallery->Title = $_POST["txtImageTitle"];
                $Gallery->ID = $_POST["txtID"];

                try {
                    $Gallery->Update();
                    $id = $Gallery->ID;

                    if (isset($_FILES["txtImage"]) && $_FILES["txtImage"]["name"] != '') {

                        $Image = $_FILES["txtImage"]["name"];
                        $info = new SplFileInfo($Image);
                        $newName =  "./Gallery/" . $id . "F." . $info->getExtension();

                        move_uploaded_file($_FILES["txtImage"]["tmp_name"], $newName);


                        $Gallery->Image = $newName;
                        $Gallery->AddImage();
                    }
                    echo "Images Updated Successfully";
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
            ?>
        </aside>

        </form>
    </main>

    <main>
        <form method="post" enctype="multipart/form-data">
            <?php

            $images = Images::GetImage();
            if (sizeof($images) > 0) {
                echo '<table>';
                echo
                '<tr>
                <td>Basic Details</td>
                <td>BackGround Image</td>
                <td>Edit|Delete</td>
                </tr>';

                foreach ($images as $b) {

                    echo
                    '<tr>
                    <td> ID:' . $b->ID . '<br><br>
                    Title:' . $b->Title . '<br><br>
                    
                    <td><img src =" ' . $b->Image . '"></td>
            
                    <td>
                    <input type="hidden" name="offerID" value="' . $b->ID . '">
                    <button type="submit" name ="btnEdit" value="' . $b->ID . '">Edit</button>
                    <button type="submit" name ="btnDelete" value="' . $b->ID . '">Delete</button>
                    
                    </td>
                    </tr>';
                }

                echo '</table>';
            } else {
                echo "No Offer Info Founded";
            }
            ?>
    </main>
    <footer>
        <p>&copy;2022 Web Devolopment</p>
    </footer>
</body>

</html>