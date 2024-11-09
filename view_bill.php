<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="view_bill.css">
    <nav class="nav-menu">
        <button class="back-button" onclick="document.location = 'update.php'">&larr;</button>
        
    </nav>
    
</head>
<body>
    <div class="container">
        <div class="bill-header">
            <h1>Bill</h1>
            <button class="print-button" onclick="window.print()">Print Bill</button>
        </div>
        <?php
        session_start();
        include("db.php");

        $id = $_GET['id'];

        $sql = "SELECT * FROM pickup WHERE order_id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='bill-details'>";
                echo "<h3><strong>Online Laundry Service</strong></h3>";
                echo "<p><strong>Order ID:</strong> " . $row["order_id"] . "</p>";
                echo "<p><strong>Register ID:</strong> " . $row["user_id"] . "</p>";
                echo "<p><strong>Name:</strong> " . $row["fname"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p><strong>Contact:</strong> " . $row["contact"] . "</p>";
                echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
                echo "<p><strong>Pincode:</strong> " . $row["pincode"] . "</p>";
                echo "<p><strong>Service:</strong> " . $row["service"] . "</p>";

                if (isset($_POST['total_weight'])) 
                {
                    $totalWeight = $_POST['total_weight'];
                    $deliveryCharges = 40;
                    $service = $row["service"];
                    $weightAmount = 0;

                    switch ($service) 
                    {
                        case "Wash and Fold":
                            $weightAmount = 45 * $totalWeight;
                            break;
                        case "Wash and Iron":
                            $weightAmount = 75 * $totalWeight;
                            break;
                        case "Dry Cleaning":
                            $weightAmount = 100 * $totalWeight;
                            break;
                        case "Express Laundry":
                            $weightAmount = 110 * $totalWeight;
                            break;
                        default:
                            echo "<p>Please select a valid service type.</p>";
                            die();
                    }

                    $totalAmount = $weightAmount + $deliveryCharges;

                    echo "<p><strong>Total Weight:</strong> " . $totalWeight . " kilos</p>";
                    echo "<p><strong>Weight Amount:</strong> Rs." . $weightAmount . "</p>";
                    echo "<p><strong>Delivery Charges:</strong> Rs." . $deliveryCharges . "</p>";
                    echo "<p><strong>Total Amount:</strong> Rs." . $totalAmount . "</p>";
                    echo"<h4>Thank You for choosing us!!<br>We look forward to serving you again!!</h4>";
                } 
                else 
                {
                    echo "<form method='post'>";
                    echo "<label for='total_weight'>Total Laundry Weight (in kilos):</label><br>";
                    echo "<input type='text' id='total_weight' name='total_weight'><br>";
                    echo "<input type='submit' class='calculate-button' value='Calculate Total Amount'>";
                    echo "</form>";
                }

                echo "</div>";
            }
        } 
        else 
        {
            echo "<p>No items found for ID: $id</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>