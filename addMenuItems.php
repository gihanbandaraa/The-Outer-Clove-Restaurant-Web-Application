<?php
include("PHP/Menufunction.php");


if (isset($_POST["btnEdit"])) {
    $myMenu = Menu::GetMenu($_POST["btnEdit"]);
}

if (isset($_POST["btnDelete"])) {
    $offerToDelete = new Menu();
    $offerToDelete->ID = $_POST["offerID"];

    try {
        $offerToDelete->Delete();
        echo "Menu Item deleted successfully.";
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
    <title>Add To Menu</title>
    <link rel="stylesheet" href="./Css/admin.css">
</head>

<body>

    <div class="add-menu-items">
        <aside>

            <h1 style="text-align: center;">Menu Item Add Form</h1>
            <form method="post" enctype="multipart/form-data">
                <ul>
                    <div class="textArea">
                        <li><input type="text" name="txtTitle" placeholder="Item Title" required value="<?php
                                                                                                        if (isset($myMenu))
                                                                                                            echo $myMenu->Title;
                                                                                                        ?>"></li>
                        <li><input type="text" name="txtPrice" placeholder="Price of the Item" required value="<?php
                                                                                                                if (isset($myMenu))
                                                                                                                    echo $myMenu->Price;
                                                                                                                ?>"></li>
                        <select name="txtCategory" required style="margin: 10px;">
                            <option value="">Select Category</option>
                            <option value="Rice Dishes" <?php if (isset($myMenu) && $myMenu->Category === 'Rice Dishes') echo 'selected'; ?>>Rice Dishes</option>
                            <option value="Snacks and Street Food" <?php if (isset($myMenu) && $myMenu->Category === 'Snacks and Street Food') echo 'selected'; ?>>Snacks and Street Food</option>
                            <option value="Hoppers and Rotis" <?php if (isset($myMenu) && $myMenu->Category === 'Hoppers and Rotis') echo 'selected'; ?>>Hoppers and Rotis</option>
                            <option value="Beverages" <?php if (isset($myMenu) && $myMenu->Category === 'Beverages') echo 'selected'; ?>>Beverages</option>
                          
                        </select>
                    </div>

                    <li>Item Discription</li>
                    <li><textarea name="txtDes" cols="21" rows="10"><?php
                                                                    if (isset($myMenu))
                                                                        echo $myMenu->Description;
                                                                    ?></textarea></li>

                    <li>Add Image<input type="file" name="txtItemImage" style="margin-top: 10px;"><?php if (isset($myMenu)) {
                                                                                                        echo '<img src ="' . $myMenu->Image . '" width = "150px" height="150px" >';
                                                                                                        echo '<input type="hidden" name ="txtID" value ="' . $myMenu->ID . '">';
                                                                                                    }
                                                                                                    ?>
                    </li>

                    <li>
                        <input type="submit" value="Add" name="btnAddItem">
                        <input type="submit" value="Update" name="btnUpdateItem">
                        <input type="submit" value="Delete" name="btnDeleteItem">
                    </li>


                </ul>

            </form>

            <?php

            if (isset($_POST["btnAddItem"])) {

                $menu = new Menu;

                $menu->Title = $_POST["txtTitle"];
                $menu->Description = $_POST["txtDes"];
                $menu->Price = $_POST["txtPrice"];
                $menu->Category = $_POST["txtCategory"];


                try {

                    $id = $menu->Add();

                    $image = $_FILES["txtItemImage"]["name"];

                    $info = new SplFileInfo($image);

                    $newName = "./MenuItems/" . $id . "F." . $info->getExtension();
                    move_uploaded_file($_FILES["txtItemImage"]["tmp_name"], $newName);

                    $menu->ID = $id;
                    $menu->Image = $newName;

                    $menu->UpdateImage();

                    echo "Image Added Successfully";
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            } elseif (isset($_POST["btnUpdateItem"])) {
                $menu = new Menu;

                $menu->Title = $_POST["txtTitle"];
                $menu->Description = $_POST["txtDes"];
                $menu->Price = $_POST["txtPrice"];

                $menu->ID = $_POST["txtID"];

                try {

                    $menu->Update();
                    $id = $menu->ID;

                    if (isset($_FILES["txtItemImage"]) && $_FILES["txtFcotxtItemImagever"]["name"] != '') {

                        $image = $_FILES["txtItemImage"]["name"];
                        $info = new SplFileInfo($image);
                        $newName = "./MenuItems/" . $id . "F." . $info->getExtension();
                        move_uploaded_file($_FILES["txtItemImage"]["tmp_name"], $newName);
                        $menu->Image = $newName;
                        $menu->UpdateImage();
                    }
                    echo "Image Updated Successfully";
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
            ?>
        </aside>
    </div>

    <main>
        <form method="post" enctype="multipart/form-data">
            <?php

            $menu = Menu::GetMenus();
            if (sizeof($menu) > 0) {
                echo '<table>';
                echo
                '<tr>
                <td>Basic Details</td>
                <td>BackGround Image</td>
                <td>Edit|Delete</td>
                </tr>';

                foreach ($menu as $b) {

                    echo
                    '<tr>
                    <td> ID:' . $b->ID . '<br><br>
                    Title:' . $b->Title . '<br><br>
                    Price:' . $b->Price . '<br><br>
                    Description:<br>' . $b->Description . '<br><br>
    
                    
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