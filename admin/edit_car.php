<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE id=$id";
    $result = $conn->query($sql);
    $car = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $carName = $_POST['car_name'];
    $manufacturingYear = $_POST['manufacturing_year'];
    $price = $_POST['price'];

    $sql = "UPDATE cars SET car_name='$carName', manufacturing_year='$manufacturingYear', price='$price' WHERE id=$id";
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
    <title>Edit Car</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Car</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="edit_car.php">
            <input type="hidden" name="id" value="<?php echo $car['id']; ?>">
            <div class="form-group">
                <label for="car_name">Car Name:</label>
                <input type="text" class="form-control" id="car_name" name="car_name" value="<?php echo $car['car_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="manufacturing_year">Manufacturing Year:</label>
                <input type="text" class="form-control" id="manufacturing_year" name="manufacturing_year" value="<?php echo $car['manufacturing_year']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $car['price']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Car</button>
        </form>
    </div>
</body>
</html>
