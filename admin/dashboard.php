<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once '../config/db.php';

// Fetch car data
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

// Fetch statistics
$totalCars = $result->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Admin Dashboard</h2>
        <p>Total Cars: <?php echo $totalCars; ?></p>
        <a href="add_car.php" class="btn btn-success">Add New Car</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Car Name</th>
                    <th>Manufacturing Year</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['car_name']; ?></td>
                        <td><?php echo $row['manufacturing_year']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_car.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
