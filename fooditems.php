<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$outOfStockItems = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    // Fetch quantities from the form
    $pizza = isset($_POST['pizza']) ? $_POST['pizza'] : 0;
    $burger = isset($_POST['burger']) ? $_POST['burger'] : 0;
    $salad = isset($_POST['salad']) ? $_POST['salad'] : 0;
    $popcorn = isset($_POST['popcorn']) ? $_POST['popcorn'] : 0;
    $chocopie = isset($_POST['chocopie']) ? $_POST['chocopie'] : 0;
    $wings = isset($_POST['wings']) ? $_POST['wings'] : 0;
    $pepsi = isset($_POST['pepsi']) ? $_POST['pepsi'] : 0;
    $meatballs = isset($_POST['meatballs']) ? $_POST['meatballs'] : 0;
    $vegBurger = isset($_POST['vegBurger']) ? $_POST['vegBurger'] : 0;
    $mushroomMomos = isset($_POST['mushroomMomos']) ? $_POST['mushroomMomos'] : 0;
    $frenchFries = isset($_POST['frenchFries']) ? $_POST['frenchFries'] : 0;
    $vegNuggets = isset($_POST['vegNuggets']) ? $_POST['vegNuggets'] : 0;
    $total_amount = $_POST['total_amount'];

    // Check if any item quantity exceeds 20
    if ($pizza > 20) $outOfStockItems[] = 'Pizza';
    if ($burger > 20) $outOfStockItems[] = 'Burger';
    if ($salad > 20) $outOfStockItems[] = 'Salad';
    if ($popcorn > 20) $outOfStockItems[] = 'Popcorn';
    if ($chocopie > 20) $outOfStockItems[] = 'Chocopie';
    if ($wings > 20) $outOfStockItems[] = 'Wings';
    if ($pepsi > 20) $outOfStockItems[] = 'Pepsi';
    if ($meatballs > 20) $outOfStockItems[] = 'Meatballs';
    if ($vegBurger > 20) $outOfStockItems[] = 'Veg Burger';
    if ($mushroomMomos > 20) $outOfStockItems[] = 'Mushroom Momos';
    if ($frenchFries > 20) $outOfStockItems[] = 'French Fries';
    if ($vegNuggets > 20) $outOfStockItems[] = 'Veg Nuggets';

    if (empty($outOfStockItems)) {
        // Define prices for each item
        $pizzaPrice = 200;
        $burgerPrice = 120;
        $saladPrice = 80;
        $popcornPrice = 200;
        $chocopiePrice = 100;
        $wingsPrice = 200;
        $pepsiPrice = 50;
        $meatballsPrice = 200;
        $vegBurgerPrice = 100;
        $mushroomMomosPrice = 150;
        $frenchFriesPrice = 70;
        $vegNuggetsPrice = 90;

        // Calculate total cost
        $totalCost = ($pizza * $pizzaPrice) + ($burger * $burgerPrice) + ($salad * $saladPrice) + ($popcorn * $popcornPrice) + ($chocopie * $chocopiePrice) + ($wings * $wingsPrice) + ($pepsi * $pepsiPrice) + ($meatballs * $meatballsPrice) + ($vegBurger * $vegBurgerPrice) + ($mushroomMomos * $mushroomMomosPrice) + ($frenchFries * $frenchFriesPrice) + ($vegNuggets * $vegNuggetsPrice);

        // Insert order details into the database
        $sql = "INSERT INTO foodd (name, number, address, pizza, burger, salad, popcorn, chocopie, wings, pepsi, meatballs, vegBurger, mushroomMomos, frenchFries, vegNuggets, totalCost) VALUES ('$name', '$number', '$address', '$pizza', '$burger', '$salad', '$popcorn', '$chocopie', '$wings', '$pepsi', '$meatballs', '$vegBurger', '$mushroomMomos', '$frenchFries', '$vegNuggets', '$totalCost')";
        if ($conn->query($sql) === TRUE) {
            header("Location: scssorder.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
    <style>
        body {
            background-color: #00bfff;
        }
        .quantity-buttons {
            display: flex;
            align-items: center;
        }
        .quantity-buttons button {
            margin: 0 5px;
        }
    </style>
    <script>
        const prices = {
            pizza: 200,
            burger: 120,
            salad: 80,
            popcorn: 200,
            chocopie: 100,
            wings: 200,
            pepsi: 50,
            meatballs: 200,
            vegBurger: 100,
            mushroomMomos: 150,
            frenchFries: 70,
            vegNuggets: 90
        };

        function incrementValue(id) {
            var value = parseInt(document.getElementById(id).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById(id).value = value;
            calculateTotal();
        }

        function decrementValue(id) {
            var value = parseInt(document.getElementById(id).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById(id).value = value;
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            for (const item in prices) {
                const quantity = parseInt(document.getElementById(item).value, 10) || 0;
                total += quantity * prices[item];
            }
            document.getElementById('totalCost').innerText = 'Total Cost: Rs. ' + total;
            document.getElementById('total_amount').value = total;
        }
    </script>
</head>
<body>
    <?php if (!empty($outOfStockItems)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo implode(', ', $outOfStockItems); ?> is/are out of stock!
        </div>
    <?php endif; ?>
    <form action="fooditems.php" method="post">
        <table class="table text-center text-capitalize" style="background-color: white;">
            <tr>
                <td>
                    <img src="images/pizza2.png" width="200px" height="200px"><br>
                    <label for="pizza">Pizza (Rs. 200):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('pizza')">-</button>
                        <input type="number" name="pizza" value="0" id="pizza" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('pizza')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/burger.jpg" width="200px" height="200px"><br>
                    <label for="burger">Burger (Rs. 120):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('burger')">-</button>
                        <input type="number" name="burger" value="0" id="burger" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('burger')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/salad.jpeg" width="200px" height="200px"><br>
                    <label for="salad">Salad (Rs. 80):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('salad')">-</button>
                        <input type="number" name="salad" value="0" id="salad" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('salad')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/popcorn1.jpg" width="200px" height="200px"><br>
                    <label for="popcorn">Popcorn (Rs. 200):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('popcorn')">-</button>
                        <input type="number" name="popcorn" value="0" id="popcorn" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('popcorn')">+</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="images/chocopie.jpg" width="200px" height="200px"><br>
                    <label for="chocopie">Chocopie (Rs. 100):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('chocopie')">-</button>
                        <input type="number" name="chocopie" value="0" id="chocopie" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('chocopie')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/wings.jpeg" width="200px" height="200px"><br>
                    <label for="wings">Wings (Rs. 200):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('wings')">-</button>
                        <input type="number" name="wings" value="0" id="wings" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('wings')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/pepsi.jpeg" width="200px" height="200px"><br>
                    <label for="pepsi">Pepsi (Rs. 50):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('pepsi')">-</button>
                        <input type="number" name="pepsi" value="0" id="pepsi" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('pepsi')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/meat.png" width="200px" height="200px"><br>
                    <label for="meatballs">Meatballs (Rs. 200):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('meatballs')">-</button>
                        <input type="number" name="meatballs" value="0" id="meatballs" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('meatballs')">+</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="images/veg burger2.jpg" width="200px" height="200px"><br>
                    <label for="vegBurger">Veg Burger (Rs. 100):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('vegBurger')">-</button>
                        <input type="number" name="vegBurger" value="0" id="vegBurger" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('vegBurger')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/momos.jpg" width="200px" height="200px"><br>
                    <label for="mushroomMomos">Mushroom Momos (Rs. 150):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('mushroomMomos')">-</button>
                        <input type="number" name="mushroomMomos" value="0" id="mushroomMomos" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('mushroomMomos')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/fries1.jpg" width="200px" height="200px"><br>
                    <label for="frenchFries">French Fries (Rs. 70):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('frenchFries')">-</button>
                        <input type="number" name="frenchFries" value="0" id="frenchFries" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('frenchFries')">+</button>
                    </div>
                </td>
                <td>
                    <img src="images/nuggets.jpg" width="200px" height="200px"><br>
                    <label for="vegNuggets">Veg Nuggets (Rs. 90):</label><br>
                    <div class="quantity-buttons">
                        <button type="button" class="btn btn-danger" onclick="decrementValue('vegNuggets')">-</button>
                        <input type="number" name="vegNuggets" value="0" id="vegNuggets" min="0" required>
                        <button type="button" class="btn btn-success" onclick="incrementValue('vegNuggets')">+</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <label>Name&emsp;</label><input type="text" name="name" required><br>
                    <label>Number</label>&emsp;<input type="text" name="number" required><br>
                    <label>Address</label>&emsp;<input type="text" name="address" required><br>
                    <input type="hidden" name="total_amount" id="total_amount" value="0">
                    <input type="submit" class="btn btn-success" name="submit" value="Confirm">
                    <button type="button" class="btn btn-info" id="totalCost">Total Cost: Rs. 0</button>
                    <a href="combo.php" class="btn btn-warning">Combo Offers</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


