<?php
include("./PHP/Offers.php");
include("./PHP/Gallery.php");
include("./PHP/Menufunction.php");
include("./PHP/CheckOutFunction.php");
include("./PHP/reservation.php");
include("./PHP/feedback.php");

$countOffers = Offers::GetOfferCount();
$countImages =Images::GetImageCount();
$countMenu =Menu::GetMenuCount();
$countOrders=CheckOut::GetOrderCount();
$countPendingOrders=CheckOut::GetOrderPendingCount();
$countFeedback=FeedBack::GetFeedbackCount();
$countReservation=Reservations::GetReservationCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OUTER CLOVE |Admin Dashboard</title>
    <link rel="stylesheet" href="Css/adminHome.css">
</head>

<body class="">
    <header>
        <img src="Images/menu-btn.png" alt="menu-button" class="menu-btn">
        <h1>Admin Dashboard</h1>
    </header>

    <main>

        <aside class="sidebar">
            <ul>
                <li><a href="./addOffers.php">Add Offers</a></li>
                <li><a href="./addImages.php">Add Images to Gallery</a></li>
                <li><a href="./addMenuItems.php">Add Items to Menu</a></li>
                <li><a href="./viewOrders.php">View Orders</a></li>
                <li><a href="./addAdmin.php">Add Admin Accounts</a></li>
                <li><a href="./viewMessages.php">View Messages</a></li>
                <li><a href="./manageFeedbacks.php">Manage Feedback</a></li>
                <li><a href="./manageReservation.php">Manage Reservations</a></li>

            </ul>
        </aside>


        <section class="dashboard">

            <div class="card">
                <h2>Completed Orders</h2>
                <p style="color: white; padding:10px; background-color:green;text-align:center"><?php echo $countOrders; ?></p>

                <h2>Pending Orders</h2>
                <p style="color: white; padding:10px; background-color:red;text-align:center"><?php echo $countPendingOrders; ?></p>
            </div>
            <div class="card">
                <h2>New Offers</h2>
                <p><?php echo $countOffers; ?></p>
            </div>
            <div class="card">
                <h2>Gallery Images</h2>
                <p><?php echo $countImages; ?></p>
            </div>

            <div class="card">
                <h2>Menu Items</h2>
                <p><?php echo $countMenu; ?></p>
                
            </div>

            
            <div class="card">
                <h2>Inbox</h2>
                <p><?php echo $countMenu; ?></p>
                
            </div>
            <div class="card">
                <h2>Feedback Count</h2>
                <p><?php echo $countFeedback; ?></p>
                
            </div>
            <div class="card">
                <h2>Reservation Count</h2>
                <p><?php echo $countReservation; ?></p>
                
            </div>

        </section>
    </main>

    <footer>
        <div class="footer-container" id="copyright">
            <p>Copyright &copy; 2023 The Outer Clove</p>
        </div>
    </footer>

    <script>
        let iconMenu = document.querySelector('.menu-btn');
        let body = document.querySelector('body');

        iconMenu.addEventListener('click', () => {
            body.classList.toggle('showsideBar')
        })
    </script>

</body>

</html>