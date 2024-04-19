<?php
include("PHP/Offers.php");
include("PHP/Gallery.php");


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
    <title>OUTER CLOVE | HOME</title>

    <link rel="stylesheet" href="Css/style.css">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
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

        function redirectToMenu() {
            window.location.href = './Menu.php';
        }

        $(function() {
            $("#footer-section").load("footer_section.html");
        });
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <li class="user-name"><?php echo "Hi, $Username"; ?></li>
            <?php } else { ?>
                <li class="loginbtn"><a href="./login_form.php">LOGIN</a></li>
            <?php } ?>
        </ul>

        <img src="Images/menu-btn.png" alt="" class="menu-btn">

    </nav>
    <!--End Of Navigations -->

    <!-- Header Section -->
    <header>
        <div class="header-content">
            <h1>AUTHENTIC SRILANKAN FOODS</h1>
            <h3>At the Outer Clove,Immers yourself in a Culinary Journey,Where every dishes tells a<br> flavorful tale
                of
                excellence and satisfaction</h3>

            <a href="" class="ctn" id="booktableBtn">Book A Table</a>
            <div class="reservation-section"></div>
        </div>


        <div id="reservationModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Online Reservation</h2>
                <form action="process_reservation.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required><br><br>
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>

    </header>
    <!-- End Of the Header Section -->

    <!-- Speciality Section -->
    <section class="speciality">
        <div class="row">

            <div class="col">
                <img src="Images/ingridiants.webp" alt="image of ingridiants">
                <h1>Fresh Ingridiants</h1>
                <p>Experience Culinary <br>Bliss: A Symphony of <br> Fresh, Vibrant Flavors</p>
            </div>
        </div>

        <div class="row" id="row-2">
            <div class="col">
                <img src="Images/Flavours.webp" alt="image of flavors">
                <h1>Handmade Flavors</h1>
                <p>Where Every Bite Tells a Delicious Tale</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <img src="Images/recipe.jpg" alt="image of foods">
                <h1>"Secret" Recipes</h1>
                <p>Unlocking the Magic: Our Exclusive 'Secret' Recipes Await</p>
            </div>
        </div>
    </section>
    <!-- End OF Speciality Section -->

    <!-- Services Section -->
    <section class="menu">
        <div class="menu-section-services">

            <div class="row">
                <div class="col">
                    <ul class="services">
                        <li>
                            <h1>Bringing Happiness to You</h1>
                            <h3>Delivering Joy One Bite At A Time</h3>
                        </li>

                        <li>
                            <i class="fas fa-mobile-alt" id="ser-icons"></i>
                            <h2>Online Delivery <br></h2>
                            <p>Order Online <i class="fas fa-solid fa-arrow-right"></i></p>
                        </li>

                        <li>
                            <i class="fas fa-solid fa-boxes-packing" id="ser-icons"></i>
                            <h2>Click And Collect <br></h2>
                            <p>Take Out Order <i class="fas fa-solid fa-arrow-right"></i></p>
                        </li>

                        <li>
                            <i class="fa-solid fa-utensils" id="ser-icons"></i>
                            <h2>Restaurant Dining</h2>
                            <p>Book A Table <i class="fas fa-solid fa-arrow-right"></i></p>
                        </li>

                        <li>
                            <i class="fa-solid fa-square-parking" id="ser-icons"></i>
                            <h2>Parking Available</h2>
                            <p>Come And Visit<i class="fas fa-solid fa-arrow-right"></i></p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Of Speciality Section  -->

    <!-- Menu Navigation Section -->
    <section class="navigation-to-menu">
        <div class="menu-nav">
            <div class="text-section">
                <p class="small-text">Choose Your Flavors</p>
                <h1>Food That Brings People's Together !!</h1>
                <p>"Indulge in our diverse, flavorful menu, showcasing handcrafted dishes <br> inspired by fresh,
                    seasonal
                    ingredients and culinary expertise."</p>
                <a href="Menu.php">View All Menu</a>
            </div>
            <section class="speciality-menu">
                <div class="row-menu">

                    <div class="col">
                        <img src="Images/Milkrice.avif" alt="image of ingridiants">
                        <h1>MILK RICE</h1>

                    </div>
                </div>

                <div class="row-menu" id="row-2">
                    <div class="col">
                        <img src="Images/Kottu.jpg" alt="image of flavors">
                        <h1>KOTTU</h1>

                    </div>
                </div>

                <div class="row-menu" id="row-2">
                    <div class="col">
                        <img src="Images/nasigoreng.webp" alt="image of flavors">
                        <h1>NASIGORENG</h1>

                    </div>
                </div>

                <div class="row-menu">
                    <div class="col">
                        <img src="Images/hopper.jpg" alt="image of foods">
                        <h1>HOPPERS</h1>
                    </div>
                </div>
        </div>
    </section>
    <!-- End Of Menu Navigation Section -->

    <!-- Offers Section -->

    <section class="best-deals" id="best-deals">
        <h1>Best Deals !</h1>

        <div class="product-offers">


            <?php

            $offers = Offers::GetOffer();

            echo '<form method="post">';

            $row = 0;
            foreach ($offers as $offer) {
                echo '<div class="offer-container">
                <img src="' . $offer->Image . '" alt="Item Image">
                <div class="title">' . $offer->Title . '</div>
                <div class="price">Rs.' . $offer->Price.'</div>
                <div class="percentage">' . $offer->Percentage . '%' . '</div>
                <a href="Menu.php" class="order-button">Order Now</a>
                </div>';
                $row++;
            }
            echo '</form>';
            ?>
        </div>
    </section>

    <!-- End Of Offer Section -->

    <!-- Our Location Section -->
    <section class="locations">
        <div class="location-header">
            <p>Our Locations</p>
            <h1>Find The Outer Clove Near You</h1>
            <p class="sub-text">Locate Your Nearest Outer Clove Spot for Delicious
                Culinary Experiences Around the Corner!</p>
        </div>

        <div class="location-details">
            <div class="location-container">
                <h1>Colombo</h1>
                <p>25, Flower Road, Colombo 07
                    <br>Phone: +94 77 123 4567
                </p>
            </div>

            <div class="location-container">
                <h1>Galle</h1>
                <p>10A, Galle Road, Mount Lavinia
                    <br>Phone: +94 76 234 5678
                </p>
            </div>

            <div class="location-container">
                <h1>Wattala</h1>
                <p>8, Negombo Road, Wattala
                    <br>Phone: +94 70 456 7890
                </p>
            </div>

            <div class="location-container">
                <h1>Kandy</h1>
                <p>57, Hill Street, Kandy
                    <br>Phone: +94 71 345 6789
                </p>
            </div>
        </div>
    </section>
    <!--End Of Our Location  -->

    <!-- Gallery Section -->
    <section class="gallery-container">
        <h1>OUR CUSTOMERS</h1>
        <div class="gallery-wrapper">

            <?php
            $Images = Images::GetImage();
            $row = 0;
            foreach ($Images as $Image) {
                echo
                '<div class="gallery-image">
                <img src="' . $Image->Image . '" alt="' . $Image->Title . '">
                </div>';
                $row++;
            }
            ?>
        </div>
        <!-- End Of Gallery Section -->

        <!-- Contact Us From Social Media -->

        <div class="social-media">

            <div class="social-media-container">
                <h1>Follow US @OuterClove</h1>
                <p>
                    Stay Connected! Follow Us <br>
                    on Instagram for Delicious Updates <br>
                    and Culinary Delights.
                </p>
                <i class="fa-brands fa-instagram"></i><br>
                <a href="https://www.instagram.com/" class="social-btn">Instagram</a>
            </div>

            <div class="social-media-container">
                <h1>Follow US @OuterClove</h1>
                <p>
                    Stay Connected! Follow Us <br>
                    on Facebook for Delicious Updates <br>
                    and Culinary Delights.
                </p>
                <i class="fa-brands fa-facebook"></i><br>
                <a href="https://www.facebook.com/" class="social-btn">Facebook</a>
            </div>

            <div class="social-media-container">
                <h1>Follow US @OuterClove</h1>
                <p>
                    Stay Connected! Follow Us <br>
                    on TikTok for Delicious Updates <br>
                    and Culinary Delights.
                </p>
                <i class="fa-brands fa-tiktok"></i><br>
                <a href="https://www.Tiktok.com/" class="social-btn">Tik Tok</a>
            </div>
        </div>
    </section>

    <!-- End Of Social Media -->

    <!-- Add Feedback -->

    <section class="feedback">
        <div class="wrapper">
            <h3>Enter Your Feedback</h3>
            <form id="feedbackForm">
                <div class="rating">
                    <input type="number" name="rating" hidden>
                    <i class='bx bx-star star' style="--i: 0;"></i>
                    <i class='bx bx-star star' style="--i: 1;"></i>
                    <i class='bx bx-star star' style="--i: 2;"></i>
                    <i class='bx bx-star star' style="--i: 3;"></i>
                    <i class='bx bx-star star' style="--i: 4;"></i>
                </div>
                <textarea name="opinion" id="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                <div class="btn-group">
                    <button type="button" class="btn submit" id="submitFeedback">Submit</button>
                    <button type="button" class="btn cancel">Cancel</button>
                </div>
            </form>
        </div>
    </section>
    <div id="successMessage" style="display: none; background-color: #4CAF50; color: white; padding: 10px; text-align: center;">
        Feedback submitted successfully!
    </div>

    <!-- End of Feedback -->
    <section class="feedback-section">
        <h2>Customer Feedback</h2>
        <div id="feedbackDisplay" class="feedback-container">
            <!-- Feedback will be displayed here -->
        </div>
    </section>

    

    <!-- Footer Section -->

    <footer id="footer-section">
    </footer>

    <!-- End of Footer  -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById("reservationModal");
            const btn = document.getElementById("booktableBtn");
            const span = document.getElementsByClassName("close")[0];

            btn.addEventListener('click', function(event) {
                event.preventDefault();
                modal.style.opacity = "1";
                modal.style.display = "block";
                modal.querySelector(".modal-content").style.transform = "scale(1)";
            });

            span.onclick = function() {
                modal.style.opacity = "0";
                modal.querySelector(".modal-content").style.transform = "scale(0)";
                setTimeout(() => {
                    modal.style.display = "none";
                }, 300);
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.opacity = "0";
                    modal.querySelector(".modal-content").style.transform = "scale(0)";
                    setTimeout(() => {
                        modal.style.display = "none";
                    }, 300);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const reservationSuccess = urlParams.get('reservation');

            if (reservationSuccess === 'success') {

                const successMessage = document.createElement('div');
                successMessage.textContent = 'Reservation submitted successfully!';
                successMessage.style.backgroundColor = '#4CAF50';
                successMessage.style.color = 'white';
                successMessage.style.padding = '10px';
                successMessage.style.textAlign = 'center';
                successMessage.style.margin = '15px';

                const reservationSection = document.querySelector('.reservation-section');
                reservationSection.appendChild(successMessage);
                setTimeout(() => {
                    successMessage.remove();
                }, 5000);
            }
        });


        document.addEventListener('DOMContentLoaded', () => {
            const allStar = document.querySelectorAll('.rating .star');
            const ratingValue = document.querySelector('.rating input');
            const opinion = document.getElementById('opinion');

            allStar.forEach((item, idx) => {
                item.addEventListener('click', function() {
                    let click = 0;
                    const selectedRating = idx + 1;
                    ratingValue.value = selectedRating;

                    allStar.forEach(i => {
                        i.classList.replace('bxs-star', 'bx-star');
                        i.classList.remove('active');
                    });

                    for (let i = 0; i < allStar.length; i++) {
                        if (i <= idx) {
                            allStar[i].classList.replace('bx-star', 'bxs-star');
                            allStar[i].classList.add('active');
                        } else {
                            allStar[i].style.setProperty('--i', click);
                            click++;
                        }
                    }
                });
            });

            document.getElementById('submitFeedback').addEventListener('click', () => {
                const selectedRating = ratingValue.value;
                const userOpinion = opinion.value;

                fetch('process_feedback.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `rating=${selectedRating}&opinion=${userOpinion}`,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            console.log('Feedback submitted successfully');
                            document.getElementById('successMessage').style.display = 'block';

                        } else {
                            console.error('Error:', data.message);
                            alert('Feedback submission failed. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was a problem submitting feedback. Please try again later.');
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            fetch('fetch_feedback.php')
                .then(response => response.json())
                .then(data => {
                    const feedbackDisplay = document.getElementById('feedbackDisplay');
                    if (data.length > 0) {
                        data.forEach(feedback => {
                            const {
                                rating_stars,
                                opinion
                            } = feedback;

                            const feedbackItem = document.createElement('div');
                            feedbackItem.classList.add('feedback-item');

                            const stars = document.createElement('div');
                            stars.classList.add('stars');
                            stars.innerHTML = getStarIcons(rating_stars);

                            const opinionText = document.createElement('p');
                            opinionText.textContent = `${opinion}`;

                            feedbackItem.appendChild(stars);
                            feedbackItem.appendChild(opinionText);

                            feedbackDisplay.appendChild(feedbackItem);
                        });
                    } else {
                        feedbackDisplay.innerHTML = '<p>No feedback available</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            function getStarIcons(count) {
                let starIcons = '';
                for (let i = 0; i < count; i++) {
                    starIcons += '<i class="star-icon">★</i>';
                }
                return starIcons;
            }
        });
    </script>
</body>

</html>