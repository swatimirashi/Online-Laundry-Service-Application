<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Service Dashboard</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="registeredpeople.css">
</head>
<body>
    <header>
    <nav class="nav-menu">
        <button class="back-button" onclick="document.location = 'dashboard.php'">&larr;</button>
        <button class="front-button" onclick="document.location = 'orderedpeople.php'">&rarr;</button>
    </nav>
        <h2>Online Laundry Services</h2>
        <nav>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="registeredpeople.php" class="active">REGISTERED</a>
            <a href="orderedpeople.php">ORDERED</a>
            <a href="update.php">UPDATES</a>
        </nav>
    </header>
    <h1>Registered People</h1>
    <table>
        <tr>
        <th>Register ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Address</th>
        </tr>
            <?php
            include("db.php");

            $sql = "SELECT id, fname, email, contact, address FROM registration";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";  
                    echo "<td>" . $row["fname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["contact"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "</tr>";
                }
            } 
            else 
            {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }

            $conn->close();
            ?>
    </table>
</body>
</html>