<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetching user data with prepared statement to prevent SQL Injection
$sql = "SELECT * FROM Customers WHERE CustomerID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "User not found.";
    exit();
}

// Updating user profile with prepared statement and sanitizing data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $newName = htmlspecialchars($_POST['new_name']);
    $newEmail = htmlspecialchars($_POST['new_email']);
    $newPhone = htmlspecialchars($_POST['new_phone']);

    // prepared statement to prevent SQL Injection
    $updateSql = "UPDATE Customers SET Name = ?, Email = ?, Phone = ? WHERE CustomerID = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$newName, $newEmail, $newPhone, $user_id]);

    
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Deleting user account with prepared statement to prevent SQL Injection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    $deleteSql = "DELETE FROM Customers WHERE CustomerID = ?";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->execute([$user_id]);

    session_destroy();
    header("Location: index.php");
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
        <p>Welcome back, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <p>Name: <?= htmlspecialchars($user['Name']) ?></p>
        <p>Email: <?= htmlspecialchars($user['Email']) ?></p>
        <p>Phone: <?= htmlspecialchars($user['Phone']) ?></p>

        <!-- using htmlspecialchars for dealing with SQL Injections -->
        <form method="post" action="">
            <h3>Update Profile</h3>
            <label for="new_name">New Name:</label>
            <input type="text" name="new_name" value="<?= htmlspecialchars($user['Name']) ?>" required>

            <label for="new_email">New Email:</label>
            <input type="email" name="new_email" value="<?= htmlspecialchars($user['Email']) ?>" required>

            <label for="new_phone">New Phone:</label>
            <input type="text" name="new_phone" value="<?= htmlspecialchars($user['Phone']) ?>" required>

            <button type="submit" name="update_profile" class="btn btn-success">Update</button>
        </form>

        <form method="post" action="">
            <h3>Delete Account</h3>
            <p>This will delete your account</p>
            <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
</body>
</html>
