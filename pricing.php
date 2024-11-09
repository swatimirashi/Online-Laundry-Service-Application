<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Services</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="pricing2.css">
</head>
<body>
    <header>
    <nav class="nav-menu">
        <button class="back-button" onclick="document.location = 'services.php'">&larr;</button>
        <button class="front-button" onclick="document.location = 'about us.php'">&rarr;</button>
    </nav>
        <h2>Online Laundry Services</h2>
        <nav class="nav-menu">
            <a href="home.php">HOME</a>
            <a href="services.php">PROCESS</a>
            <a href="pricing.php" class="active">PRICING</a>
            <a href="about us.php">ABOUT US</a>
        </nav>
        <button class="bookapickup" onclick="document.location='myaccount.php'">My Account</button> 
    </header>
    <div class="container">
        <div class="box">
            <h2>Wash and Fold</h2>
            <p>Convenient and quick service for your everyday laundry needs.</p>
            <h3 class="price">₹45/kilo</h3>
            <P><b>+</b></P>
            <P>Pickup & Delivery charges:₹40 Extra</p>
            <p>DELEVERY WITHIN:48HRS</p>
            <button class="book-now" onclick="location.href='pickup.php'">Book Now</button>
            <img src="price1.jpg" class="image">
        </div>
        <div class="box">
            <h2>Wash and Iron</h2>
            <p>Get your clothes washed and ironed for a crisp, fresh look.</p>
            <h3 class="price">₹75/kilo</h3>
            <P><b>+</b></P>
            <P>Pickup & Delivery charges:₹40 Extra</p>
            <p>DELEVERY WITHIN:48-72HRS</p>
            <button class="book-now" onclick="location.href='pickup.php'">Book Now</button>
            <img src="price2.jpg" class="image">
        </div>
        <div class="box">
            <h2>Dry Cleaning</h2>
            <p>Professional cleaning for your delicate and special garments.</p>
            <h3 class="price">₹100/kilo</h3>
            <p><b>+</b></P>
            <P>Pickup & Delivery charges:₹40 Extra</p>
            <p>DELEVERY WITHIN:48-72HRS</p>
            <button class="book-now" onclick="location.href='pickup.php'">Book Now</button>
            <img src="price3.jpg" class="image">
        </div>
        <div class="box">
            <h2>Express Laundry</h2>
            <p>Fast service when you need your clothes cleaned in a hurry.</p>
            <h3 class="price">₹110/kilo</h3>
            <P><b>+</b></P>
            <P>Pickup & Delivery charges:₹40 Extra</p>
            <p>DELEVERY WITHIN:24HRS</p>
            <button class="book-now" onclick="location.href='pickup.php'">Book Now</button>
            <img src="price4.jpg" class="image">
        </div>
    </div>

</body>
</html>