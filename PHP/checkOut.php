<?php
include_once("CheckOutFunction.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnPlaceOrder'])) {

    if (isset($_SESSION['totalValue']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address'])) {

        $titles = $_GET['title'] ?? [];
        $prices = $_GET['price'] ?? [];
        $quantities = $_GET['quantity'] ?? [];

        $itemList = [];
        for ($i = 0; $i < count($titles); $i++) {
            $itemList[] = [
                'title' => $titles[$i],
                'quantity' => $quantities[$i],
                'price' => $prices[$i]
            ];
        }

        $details = serialize($itemList);

        $checkout = new CheckOut();
        $checkout->Name = $_POST['name'];
        $checkout->Price = $_SESSION['totalValue'];
        $checkout->Phone = $_POST['phone'];
        $checkout->Address = $_POST['address'];
        $checkout->Details = $details;
        $checkout->Status='Pending';

        try {
            $orderId = $checkout->Add();
            echo '<p>';
            echo 'Order placed successfully with ID: ' . $orderId;
            echo '</p>';
            echo '<p><a href="/index.php">HOME</a></p>: ';
            
            
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    } else {
        echo '<p>Required parameters are missing.</p>';
    }
}
?>
<a href=""></a>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> OUTER CLOVE | CHECKOUT</title>
    <link rel="stylesheet" href="../Css/checkout.css">
</head>

<body>

    <div class="checkout-container">
        <h2>Checkout</h2>
        <div class="total">
            <?php
            if (isset($_SESSION['totalValue'])) {
                $totalValue = $_SESSION['totalValue'];
                echo 'Total: $' . number_format($totalValue, 2);
            } else {
                echo 'Total: $0.00';
            }
            ?>
        </div>

        <div class="items-list">
            <?php
            if (isset($_GET['title']) && isset($_GET['price']) && isset($_GET['quantity'])) {
                $titles = $_GET['title'];
                $prices = $_GET['price'];
                $quantities = $_GET['quantity'];

                for ($i = 0; $i < count($titles); $i++) {
                    echo '<div class="item">';
                    echo '<p>' . htmlspecialchars($titles[$i]) . '  ' . $quantities[$i] . ' * ' . $prices[$i] . '$</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No items selected.</p>';
            }
            ?>
        </div>

        <form action="" method="POST">
            <label for="name">Name:<span class="required">*</span></label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Phone Number:<span class="required">*</span></label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Address:<span class="required">*</span></label>
            <textarea id="address" name="address" required></textarea>

            <h3>Credit Card Details</h3>
            <div class="card-row">
                <input type="text" id="card-number" name="card-number" placeholder="Card Number" required>
            </div>
            <div class="card-row">
                <input type="text" id="card-name" name="card-name" placeholder="Cardholder Name" required>
                <input type="text" id="card-expiry" name="card-expiry" placeholder="MM/YY" required>
                <input type="text" id="card-cvv" name="card-cvv" placeholder="CVV" required>
            </div>

            <input type="submit" value="Place Order" name="btnPlaceOrder">
        </form>
    </div>

</body>

</html>
