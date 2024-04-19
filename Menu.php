<?php
include("PHP/Menufunction.php");
include("PHP/Cartitem.php");

session_start();

$Username = '';

if (isset($_SESSION['user_name'])) {

    $Username = $_SESSION['user_name'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["btnRemove"])) {
        $r = $_POST["btnRemove"];
        $mycart = $_SESSION["cart"];
        array_splice($mycart, $r, 1);

        $_SESSION["cart"] = $mycart;
    } else if (isset($_POST["btnUpdate"])) {

        $r = $_POST["btnUpdate"];
        $Qty = $_POST["txtQty"][$r];
        $mycart = $_SESSION["cart"];

        $mycart[$r]->Qty = $Qty;
        $_SESSION["cart"] = $mycart;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUTER CLOVE | MENU</title>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.querySelector('.menu-btn');
            const navLinks = document.querySelector('.nav-links');

            if (menuBtn && navLinks) {
                menuBtn.addEventListener('click', () => {
                    navLinks.classList.toggle('mobile-menu');
                });
            } else {
                console.error("Menu button or navigation links not found!");
            }
        });



        $(function() {
            $("#footer-section").load("footer_section.html");
        });
    </script>

    <link rel="stylesheet" href="Css/menu.css">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
     integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="">

    <nav class="navbar">
        <h1 class="logo">OUTER <br>CLOVE <i class="fa-solid fa-utensils"></i></h1>
        <ul class="nav-links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="Menu.php">MENU</a></li>
            <li><a href="AboutUs.php">ABOUT</a></li>
            <li><a href="AboutUs.php#contact">CONTACT</a></li>
            <?php if (!empty($Username)) { ?>
                <li class="loginbtn"><a href="./logout.php">LOGOUT</a></li>
                <li class="user-name"><?php echo "Hi, $Username"; ?></li>
            <?php } else { ?>
                <li class="loginbtn"><a href="./login_form.php">LOGIN</a></li>
            <?php } ?>
        </ul>
        <img src="Images/menu-btn.png" alt="" class="menu-btn">

    </nav>

    <div class="ser-cat-container">
        <!-- Category Filter -->
        <div class="category">
            <form method="post" action="">
                <label for="category">Filter by Category:</label>
                <select name="category" id="category">
                    <option value="all" <?php if (!isset($_POST['category']) || $_POST['category'] === 'all') echo 'selected'; ?>>All Categories</option>
                    <option value="Rice Dishes" <?php if (isset($_POST['category']) && $_POST['category'] === 'Rice Dishes') echo 'selected'; ?>>Rice Dishes</option>
                    <option value="Snacks and Street Food" <?php if (isset($_POST['category']) && $_POST['category'] === 'Snacks and Street Food') echo 'selected'; ?>>Snacks and Street Food</option>
                    <option value="Hoppers and Rotis" <?php if (isset($_POST['category']) && $_POST['category'] === 'Hoppers and Rotis') echo 'selected'; ?>>Hoppers and Rotis</option>
                    <option value="Beverages" <?php if (isset($_POST['category']) && $_POST['category'] === 'Beverages') echo 'selected'; ?>>Beverages</option>

                </select>
                <input type="submit" value="Filter">
            </form>
        </div>

        <div class="search">
            <form method="post" action="">
                <label for="search">Search:</label>
                <input type="text" name="search" id="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>

    <section class="menu">
        <i class="fa-solid fa-cart-shopping"></i>
        <h1>Our Menu</h1>

        <form method="post" action="">
            <div class="menu-container">
                <div class="menu-item-container">
                    <?php
                    $filteredMenu = [];

                    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
                        $filteredMenu = Menu::GetMenusByCategory($_POST['category']);
                    } elseif (isset($_POST['search']) && !empty($_POST['search'])) {
                        $filteredMenu = Menu::SearchMenus($_POST['search']);
                    } else {
                        $filteredMenu = Menu::GetMenus();
                    }

                    $row = 0;
                    foreach ($filteredMenu as $menus) {
                    ?>
                        <div class="menu-item">
                            <img src="<?= $menus->Image ?>" alt="Menu Item">
                            <h2><?= $menus->Title ?></h2>
                            <h3 class="description"><?= $menus->Description ?></h3>
                            <h3 class="unit-price" style="color:#E4022F; font-size: large;">Rs.<?= $menus->Price ?></h3>
                            <h3 class="quantity">Quantity :
                                <input type="number" name="txtQty[]" value="1">
                            </h3>
                            <button name="btnAdd" value="<?= $row ?>">Add to Cart</button>
                            <input type="hidden" name="txtID[]" value="<?= $menus->ID ?>">
                            <!-- <button name="btnView" value="<?= $menus->ID ?>" onclick="toggleDescription(this)">View More</button> -->
                        </div>
                    <?php
                        $row++;
                    }
                    ?>

                    <?php
                    if (isset($_POST['btnAdd']) && isset($_POST['txtQty'])) {
                        $r = $_POST["btnAdd"];

                        $menu = Menu::GetMenu($_POST["txtID"][$r]);

                        if (!isset($_SESSION["cart"])) {
                            $mycart = array();
                            $_SESSION["cart"] = $mycart;
                        }

                        $mycart = $_SESSION["cart"];
                        $found = false;

                        if (sizeof($mycart) != 0) {
                            foreach ($mycart as $item) {
                                if ($item->ID == $_POST["txtID"][$r]) {
                                    $Qty = $item->Qty;
                                    $item->Qty = $Qty + $_POST["txtQty"][$r];
                                    $found = true;
                                    break;
                                }
                            }
                        }

                        if (!$found) {
                            $item = new CartItem;
                            $item->ID = $menu->ID;
                            $item->Title = $menu->Title;
                            $item->Image = $menu->Image;
                            $item->Price = $menu->Price;
                            $item->Qty = $_POST["txtQty"][$r];

                            array_push($mycart, $item);
                        }

                        $_SESSION["cart"] = $mycart;
                    }
                    ?>
                </div>
            </div>
        </form>

        <div class="cartTab">
            <h1>Shopping Cart <span class="closeIcon" style="color:#E4022F">(X)</span></h1>

            <div class="listcart">
                <form method="post">
                    <?php
                    $total = 0;
                    if (isset($_SESSION["cart"])) {
                        $cart = $_SESSION["cart"];

                        $row = 0;


                        foreach ($cart as $item) {
                            $class = ($row % 2 == 0) ? 'even' : 'odd';
                            echo '<div class="item"> 
                            <div class="image">
                                <img src="' . $item->Image . '"width="100px" height="100px" alt="Image of the Food Item">
                             </div>
                            <div class="name">' . $item->Title . '</div>
                            <div class="price">Rs.' . $item->Price . '</div>
            
                           
                            <div class="quantity">
                            <form method="post">
                            <input type="number" value="' . $item->Qty . '" name="txtQty[]">
            
                            <button name="btnUpdate" value="' . $row . '">Update</button>
                        
                            <button name="btnRemove" value="' . $row . '">Remove</button>
                            </form>
                            </div>
                           
                            </div>';
                            $total = $total + $item->getValue();
                            $row++;
                        }
                    } else {

                        echo '<h2 class="erro">No Items in The Display</h2>';
                    }
                    $_SESSION['totalValue'] = $total;
                    echo '<div class="total"><h2>Total = Rs.' . $total . '/=</h2></div>'
                    ?>

                    <div class="btns">
                        <button class="close">Close</button>
                        <button class="checkout" onclick="redirectToCheckout()">Check Out</button>
                    </div>
                </form>

            </div>

        </div>
    </section>


    <!-- Footer Section -->
    <footer id="footer-section">
    </footer>


    <script>
        function toggleDescription(button) {
            var parentDiv = button.parentElement;
            var description = parentDiv.querySelector('.description');

            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
            } else {
                description.style.display = 'none';
            }
        }

        let checkoutButton = document.querySelector('.checkout');
        checkoutButton.addEventListener('click', function(event) {

            if (!<?php echo json_encode(!empty($Username)); ?>) {
                <?php echo "sessionStorage.setItem('redirectToCheckout', 'true');"; ?>
                window.location.href = 'login_form.php';
                event.preventDefault();
            }
        });

        let iconCart = document.querySelector('.fa-cart-shopping');
        let body = document.querySelector('body');
        let close = document.querySelector('.close');
        let closeIcon = document.querySelector('.closeIcon');

        iconCart.addEventListener('click', () => {
            body.classList.toggle('showCart')
        })
        close.addEventListener('click', () => {
            body.classList.toggle('showCart')
        })
        closeIcon.addEventListener('click', () => {
            body.classList.toggle('showCart')
        })



        function redirectToCheckout() {
            let items = document.querySelectorAll('.listcart .item');
            let params = '';
            items.forEach(item => {
                let title = item.querySelector('.name').textContent;
                let price = item.querySelector('.price').textContent;
                let quantity = item.querySelector('.quantity input[type="number"]').value;

                params += `&title[]=${encodeURIComponent(title)}&price[]=${encodeURIComponent(price)}&quantity[]=${quantity}`;
            });
            window.location.href = `./PHP/checkOut.php?${params.substr(1)}`;
        }
    </script>
</body>

</html>