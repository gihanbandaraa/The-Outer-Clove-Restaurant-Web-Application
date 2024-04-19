<?php
include("PHP/Offers.php");


if (isset($_POST["btnEdit"])) {
    $myOffer = Offers::GetOffers($_POST["btnEdit"]);
}

if (isset($_POST["btnDelete"])) {
    $offerToDelete = new Offers();
    $offerToDelete->ID = $_POST["offerID"];

    try {
        $offerToDelete->Delete();
        echo "Offer deleted successfully.";
       
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
    <title>Add New Offers</title>
    <link rel="stylesheet" href="./Css/admin.css">
</head>

<body>

    <div class="Offer-add">
        <h1 id="addOffersHeading">Add New Offers To Restaurant (+) </h1>
    </div>
    <aside id="offerAddSection">
        <h1 style="text-align: center;">Offer Add Form</h1>
        <form method="post" enctype="multipart/form-data">
            <ul>
                <div class="textArea">
                    <li><input type="text" name="txtTitle" placeholder="Enter Offer Title" required value="<?php
                                                                                                            if (isset($myOffer))
                                                                                                                echo $myOffer->Title;
                                                                                                            ?>"></li>
                    <li><input type="text" name="txtPrice" placeholder="Enter the Price" required value="<?php
                                                                                                            if (isset($myOffer))
                                                                                                                echo $myOffer->Price;
                                                                                                            ?>"></li>
                    <li><input type="text" name="txtPercentage" placeholder="Enter the Percentage" required value="<?php
                                                                                                                    if (isset($myOffer))
                                                                                                                        echo $myOffer->Percentage;
                                                                                                                    ?>"></li>
                </div>



                <li>Cover Image <input type="file" name="txtBackImage"><?php if (isset($myOffer))
                                                                            echo '<img src ="' . $myOffer->Image . '" width = "150px" height="150px" >';
                                                                        ?></li>

                <li>
                    <input type="submit" value="Add" name="btnAdd">
                    <input type="submit" value="Update" name="btnUpdate">
                    <input type="submit" value="Delete" name="btnDelete">
                </li>
            </ul>
        </form>

        <?php

        if (isset($_POST["btnAdd"])) {

            $offer = new Offers;

            $offer->Title = $_POST["txtTitle"];
            $offer->Price = $_POST["txtPrice"];
            $offer->Percentage = $_POST["txtPercentage"];

            try {
                $id = $offer->Add();

                $backImage = $_FILES["txtBackImage"]["name"];

                $info = new SplFileInfo($backImage);
                $newName = "./OfferImages/" . $id . "F." . $info->getExtension();

                var_dump($newName);
                move_uploaded_file($_FILES["txtBackImage"]["tmp_name"], $newName);

                $offer->ID = $id;
                $offer->Image = $newName;
                $offer->UpdateImage();

                echo '<br>' . "Offer Added Successfully";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        } elseif (isset($_POST["btnUpdate"])) {
            $offer = new Offers;

            $offer->Title = $_POST["txtTitle"];
            $offer->Price = $_POST["txtPrice"];
            $offer->Percentage = $_POST["txtPercentage"];
           

            try {

                $offer->Update();
                $id = $offer->ID;

                if (isset($_FILES["txtBackImage"]) && $_FILES["txtBackImage"]["name"] != '') {

                    $backImage = $_FILES["txtBackImage"]["name"];
                    $info = new SplFileInfo($backImage);
                    $newName = "./OfferImages/" . $id . "." . $info->getExtension();

                    move_uploaded_file($_FILES["txtBackImage"]["tmp_name"], $newName);
                    $offer->Image = $newName;
                    $offer->UpdateImage();
                }
                echo "Offers Updated Successfully";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        ?>
    </aside>

    <main>
        <form method="post" enctype="multipart/form-data">
            <?php

            $offers = Offers::GetOffer();
            if (sizeof($offers) > 0) {
                echo '<table>';
                echo
                '<tr>
                <td>Basic Informations</td>
                <td>BackGround Image</td>
                <td>Edit|Delete</td>
                </tr>';

                foreach ($offers as $b) {

                    echo
                    '<tr>
                    <td> ID:' . $b->ID . '<br><br>
                    Title:' . $b->Title . '<br><br>
                    Price:' . $b->Price . '<br><br>
                    Percentage:' . $b->Percentage . '<br><br>
   
                 
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
</body>

</html>