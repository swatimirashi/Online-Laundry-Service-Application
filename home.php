
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Login and Register</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="home1.css">
    <script>
        function confirmLogout()
        {
            if(confirm('Are you sure you want to logout?'))
        {
            window.location.href='login.php';
        }
        }
    </script>
</head>
<body style="background-image:url('laundry2.jpg');background-size:50%;background-repeat:no-repeat;font-family:Arial,sans-serif;">
<header>
    <nav class="nav-menu">
        <button class="back-button" onclick="confirmLogout()">&larr;</button>
        <button class="front-button" onclick="document.location = 'services.php'">&rarr;</button>
    </nav>
        <h2>Online Laundry Services</h2>
        <nav class="nav-menu">
            
            <a href="home.php" class="active">HOME</a>
            <a href="services.php">PROCESS</a>
            <a href="pricing.php">PRICING</a>
            <a href="about us.php">ABOUT US</a>
    </nav>
    <button class="bookapickup" onclick="document.location='myaccount.php'">My Account</button>   
</header>
    
    <div class="advertisement">
        <h1>Tired of doing laundry...?</h1>
        <p><span class="highlight">The Laundry Basket</span> is now available.</p>
        <p>We offer pick-up and delivery of laundry.</p>
        <p>We provide independent wash for each customer to ensure maximum hygiene for all our customers.</p>
        <p>Say goodbye to laundry stress and hello to convenience!</p>
    </div>
</body>
</html>