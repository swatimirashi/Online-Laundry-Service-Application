<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Service Dashboard</title>
    <link rel="stylesheet" href="dashboard7.css">
    <link rel="stylesheet" href="nav.css">
</head>
<body>
    <button class="back-button" onclick="document.location = 'adminpage.html'">&larr;</button> 
    <button class="front-button" onclick="document.location = 'registeredpeople.php'">&rarr;</button>

    <header>
        <h2>Online Laundry Services</h2>     
        <nav>
            <a href="dashboard.php" class="active">DASHBOARD</a>
            <a href="registeredpeople.php">REGISTERED</a>
            <a href="orderedpeople.php">ORDERED</a>
            <a href="update.php">UPDATES</a>
        </nav>
    </header>

    <div class="card-container">
        <?php
        include 'db.php';
        $queries = 
        [
            "SELECT COUNT(*) FROM registration" => "Register People",
            "SELECT COUNT(*) FROM pickup" => "Orders",
            "SELECT COUNT(*) FROM pickup WHERE pickup_status='Picked Up'" => "Picked Up",
            "SELECT COUNT(*) FROM pickup WHERE status='In Progress'" => "Pending",
            "SELECT COUNT(*) FROM pickup WHERE status='Completed'" => "Completed",
            "SELECT COUNT(*) FROM pickup WHERE delivery_status='Delivered'" => "Delivered"
        ];

    
        foreach ($queries as $query => $label) 
        {
            $result = $conn->query($query);
            $count = $result ? $result->fetch_row()[0] : "Error";
            echo "<div class='card'><h1>$label</h1><h4>$count</h4></div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>