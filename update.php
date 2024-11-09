<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_entry"])) 
{
    $id = $_POST["id"];

    $sql = "DELETE FROM pickup WHERE order_id='$id'";
    $conn->query($sql); 
} 
$sql = "SELECT * FROM pickup";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Service Dashboard</title>
    <link rel="stylesheet" href="update.css">
    <link rel="stylesheet" href="nav.css">
    
    <script>
        function confirmDelete() 
        {
            return confirm("Are you sure you want to delete this entry?");
        }
    </script>
</head>
<button class="back-button" onclick="document.location = 'orderedpeople.php'">&larr;</button> 
<button class="front-button" onclick="document.location = 'update.php'">&rarr;</button>
<body>
    <header>
        <h2>Online Laundry Services</h2>
        <nav>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="registeredpeople.php">REGISTERED</a>
            <a href="orderedpeople.php">ORDERED</a>
            <a href="update.php" class="active">UPDATES</a>
        </nav>
    </header>
    <h1>Pickup and Delivery Updates</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Service</th>
            <th>Pickup Status</th>
            <th>Pickup Time</th>
            <th>Service Status</th>
            <th>Delivery Status</th>
            <th>Delivery Time</th>
            <th>Action</th>
        </tr>
        <?php
        session_start();
        include("db.php"); 

        $sql = "SELECT * FROM pickup";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";

                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["service"] . "</td>";
                echo "<td>" . $row["pickup_status"] . "</td>";
                echo "<td>" . $row["pickup_time"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["delivery_status"] . "</td>";
                echo "<td>" . $row["delivery_time"] . "</td>";

                echo "<td>";
                echo "<form method='post' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='id' value='" . $row["order_id"] . "'>";
                echo "<input type='submit' name='delete_entry' value='Delete' class='delete-btn'>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
        } 
        else 
        {
            echo "<tr><td colspan='9'>No data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>