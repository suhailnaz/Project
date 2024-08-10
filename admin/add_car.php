<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carName = $_POST['car_name'];
    $manufacturingYear = $_POST['manufacturing_year'];
    $price = $_POST['price'];

    $sql = "INSERT INTO cars (car_name, manufacturing_year, price) VALUES ('$carName', '$manufacturingYear', '$price')";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Add New Car</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="add_car.php">
            <div class="form-group">
                <label for="car_name">Car Name:</label>
                <input type="text" class="form-control" id="car_name" name="car_name" required>
            </div>
            <div class="form-group">
                <label for="manufacturing_year">Manufacturing Year:</label>
                <input type="text" class="form-control" id="manufacturing_year" name="manufacturing_year" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Car</button>
        </form>
    </div>
</body>
</html>
