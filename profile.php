<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM Customers WHERE CustomerID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} 
else {

    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary">Go back to Home</a>
        <h2>User Profile</h2>
        <p>Welcome back, <?= $_SESSION['username'] ?>!</p>
        <p>Name: <?= $user['Name'] ?></p>
        <p>Email: <?= $user['Email'] ?></p>
        <p>Phone: <?= $user['Phone'] ?></p>

  
    </div>
</body>
</html>
