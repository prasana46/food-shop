<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
    <style>
        body {
            background-image: url('images/vieworderbg.jpg');
            background-size: cover;
        }
        .table {
            width: 80%;
            margin: auto;
            font-size: 0.8em;
            border-collapse: collapse; /* Ensure borders are collapsed */
        }
        .table th, .table td {
            padding: 5px;
            border: 1px solid white; /* Add border to table cells */
        }
        .form-container {
            margin-top: 120px;
        }
        .form-container input[type="text"] {
            width: 50%; /* Reduced width */
            padding: 5px;
            margin: 5px 0;
            font-size: 0.8em; /* Reduced font size */
        }
        .form-container input[type="submit"] {
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 0.8em; /* Reduced font size */
        }
        .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <center>
        <div class="form-container">
            <form method="post" action="#">
                <input type="text" name="name" placeholder="Enter your name" required><br>
                <input type="text" name="phno" placeholder="Enter your number" required><br>
                <input type="submit" name="submit" value="View Order">
            </form>
        </div>
        <br>
        <table class="table table-bordered text-capitalize" style="color:white;">
            <tr>
                <th>Date and Time</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Order ID</th>
                <th>Pizza</th>
                <th>Burger</th>
                <th>Salad</th>
                <th>Popcorn</th>
                <th>Chocopie</th>
                <th>Wings</th>
                <th>Pepsi</th>
                <th>Meatballs</th>
                <th>Veg Burger</th>
                <th>Veg Nuggets</th>
                <th>French Fries</th>
                <th>Mushroom Momos</th>
                <th>Total Cost</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "foodo";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $phno = $_POST['phno'];

                $sql = "SELECT * FROM foodd WHERE name='$name' AND number='$phno' ORDER BY order_id LIMIT 1";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                } else {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["number"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["order_id"] . "</td>";
                            echo "<td>" . $row["pizza"] . "</td>";
                            echo "<td>" . $row["burger"] . "</td>";
                            echo "<td>" . $row["salad"] . "</td>";
                            echo "<td>" . $row["popcorn"] . "</td>";
                            echo "<td>" . $row["chocopie"] . "</td>";
                            echo "<td>" . $row["wings"] . "</td>";
                            echo "<td>" . $row["pepsi"] . "</td>";
                            echo "<td>" . $row["meatballs"] . "</td>";
                            echo "<td>" . $row["vegburger"] . "</td>";
                            echo "<td>" . $row["vegnuggets"] . "</td>";
                            echo "<td>" . $row["frenchfries"] . "</td>";
                            echo "<td>" . $row["mushroommomos"] . "</td>";
                            echo "<td>" . $row["totalCost"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='18'>No records found</td></tr>";
                    }
                }
            }
            mysqli_close($conn);
            ?>
        </table>
        <br>
        <a href="allorders.php" class="btn btn-dark text-capitalize">View All Order Details</a><br><br>
        <a href="homepage.php" class="btn btn-dark text-uppercase h5">Go to Login Page</a><br>
        <a href="userlogin.php" class="btn btn-dark text-uppercase h5">Home Page</a>
    </center>
</body>
</html>