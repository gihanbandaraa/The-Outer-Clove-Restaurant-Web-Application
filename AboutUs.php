<?php
include("PHP/contactUs.php");
session_start();

$Username = '';

if (isset($_SESSION['user_name'])) {

    $Username = $_SESSION['user_name'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUTER CLOVE | ABOUT US</title>
    <link rel="stylesheet" href="Css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $("#footer-section").load("footer_section.html");
        });
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
    </script>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <h1 class="logo">OUTER <br>CLOVE <i class="fa-solid fa-utensils"></i></h1>
        <ul class="nav-links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="Menu.php">MENU</a></li>
            <li><a href="AboutUs.php">ABOUT</a></li>
            <li><a href="AboutUs.php#contact">CONTACT</a></li>
            <?php if (!empty($Username)) { ?>
                <li class="loginbtn"><a href="./logout.php">LOGOUT</a></li>
                <li class="user-name">
                    <?php echo "Hi, $Username"; ?>
                </li>
            <?php } else { ?>
                <li class="loginbtn"><a href="./login_form.php">LOGIN</a></li>
            <?php } ?>
        </ul>

        <img src="Images/menu-btn.png" alt="" class="menu-btn">

    </nav>
    <section class="about-us">
        <div class="heading">
            <h1>About Us</h1>
        </div>

        <div class="about-us-container">
            <div class="about-us-content">
                <h2>Welcome to Our Restuarant Web Site</h2>
                <p> Welcome to Outer Clove! We're passionate about bringing the vibrant flavors of Sri Lanka to your table.
                    Our menu is a fusion of traditional recipes infused with exciting twists, ensuring every bite is a flavorful adventure.
                    With multiple locations, we take pride in sharing our love for exceptional food across various places.
                    Relax and indulge in our global culinary experience, knowing that we offer ample seating for up
                    to 80-100 guests and hassle-free parking at all our locations. Join us to savor a taste journey right in your neighborhood!</p>

                <button class="cta-button">Learn More</button>
            </div>
            <div class="about-us-image">
                <img src="Images/about-us.jpg" alt="">
            </div>

        </div>
    </section>

    <section class="Our-story" id="OurStory">
        <div class="heading">
            <h1>Our Story</h1>
        </div>

        <div class="Our-story-container">
            <div class="Our-story-image">
                <img src="Images/story.jpg" alt="">
            </div>
            <div class="Our-story-content">
                <h2>This Is Our Story</h2>
                <p> At Outer Clove, our story began with a shared love for flavors that transcend borders.
                    It all started in a cozy kitchen where our founder, <strong>Gihan Bandara</strong>,
                    embarked on a culinary journey fueled by a passion for global cuisine. His explorations across continents sparked the idea of creating a place where people could savor tastes from around the world without leaving their hometown.
                    With a handful of cherished family recipes and a sprinkle of innovation,
                    Outer Clove was born. From humble beginnings, we've grown to multiple locations,
                    but our ethos remains unchanged: to offer a culinary voyage that brings together diverse cultures on every plate.
                    Each dish at Outer Clove reflects not just a recipe, but a story—a tale of tradition,
                    creativity, and the joy of sharing meals with loved ones. As we continue to expand,
                    our commitment to serving authentic flavors and creating memorable dining experiences remains at the heart of everything we do</p>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <p>Get in touch with us for any inquiries or to book a table!</p>

            <form action="" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>

                <input type="submit" value="Submit" name="btnAdd">
            </form>


            <?php
            if (isset($_POST["btnAdd"])) {

                $contact = new Contact;

                $contact->Name = $_POST["name"];
                $contact->Email = $_POST["email"];
                $contact->Message = $_POST["message"];
                $contact->Status = 'Pending';


                try {
                    $id = $contact->Add();
                    $contact->ID = $id;
                    echo '<div class="success-message">
                    Message Send successfully.
                </div>';
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
            ?>

        </div>
    </section>


    <!-- Footer Section -->

    <footer id="footer-section">
    </footer>

</body>

</html>