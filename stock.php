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

// Insert stock details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_stock'])) {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO stock (item_name, quantity, unit, amount) VALUES ('$item_name', $quantity, '$unit', $amount)";
    $conn->query($sql);
}

// Update stock details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_stock'])) {
    $id = $_POST['id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];

    $sql = "UPDATE stock SET item_name='$item_name', quantity=$quantity, unit='$unit', amount=$amount WHERE id=$id";
    $conn->query($sql);
}

// Delete stock details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_stock'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM stock WHERE id=$id";
    $conn->query($sql);
}

// Fetch stock details
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

// Fetch stock details for editing
$edit_item = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_stock'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM stock WHERE id=$id";
    $edit_result = $conn->query($sql);
    if ($edit_result->num_rows > 0) {
        $edit_item = $edit_result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body ,html{ 
            background-image: linear-gradient(to right, rgb(69, 221, 226),rgb(35, 123, 126),rgb(12, 30, 31),);
        }
        th{
            border: 5px solid black;
            padding: 10px;
            background-color: #00bfff;
            color: white;
        }
        td{
            border: 5px solid black;
            padding: 10px;
            background-color: #f0fff0;
        }
        table{
            
            width: 100%;
        border-color: black;

        }
        label{
            color:black;
            
        }
        .text-center{
            color: white;
            align-items: center;
        }
        .form-control
        {
           width: 20%;
           
        }
        .mb-4{
            align-items: center;

        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Stock Details</h1>
        <form method="post" action="stock.php" class="mb-4">
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $edit_item ? $edit_item['item_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $edit_item ? $edit_item['quantity'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <select class="form-control" id="unit" name="unit" required>
                    <option value="kilograms" <?php echo $edit_item && $edit_item['unit'] == 'kilograms' ? 'selected' : ''; ?>>Kilograms</option>
                    <option value="liters" <?php echo $edit_item && $edit_item['unit'] == 'liters' ? 'selected' : ''; ?>>Liters</option>
                    <option value="milliliters" <?php echo $edit_item && $edit_item['unit'] == 'milliliters' ? 'selected' : ''; ?>>Milliliters</option>
                    <option value="grams" <?php echo $edit_item && $edit_item['unit'] == 'grams' ? 'selected' : ''; ?>>Grams</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?php echo $edit_item ? $edit_item['amount'] : ''; ?>" required>
            </div>
            <?php if ($edit_item): ?>
                <input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>">
                <button type="submit" class="btn btn-primary" name="update_stock">Update Stock</button>
                <a href="stock.php" class="btn btn-secondary">Cancel</a>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="add_stock">Add Stock</button>
            <?php endif; ?>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <form method="post" action="supplier.php">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['item_name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <form method="post" action="stock.php" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-warning btn-sm" name="edit_stock">Edit</button>
                                    </form>
                                    <form method="post" action="stock.php" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" name="delete_stock">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <input type="hidden" name="item_name[]" value="<?php echo $row['item_name']; ?>">
                            <input type="hidden" name="quantity[]" value="<?php echo $row['quantity']; ?>">
                            <input type="hidden" name="unit[]" value="<?php echo $row['unit']; ?>">
                            <input type="hidden" name="amount[]" value="<?php echo $row['amount']; ?>">
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Order Here</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No stock available.
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="supplier.php" class="btn btn-info btn-lg">Suppliers</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>