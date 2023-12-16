<?php
session_start();
include('connection.php');

$welcome_message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM Customers WHERE Username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPasswordFromDB = $row["Password"];

        if (password_verify($password, $hashedPasswordFromDB)) {
            $_SESSION["user_id"] = $row["CustomerID"];
            $_SESSION["username"] = $row["Username"];

            $welcome_message = 'Welcome back ' . $_SESSION['username'];

            echo "User ID: " . $_SESSION['user_id'];
            echo "Username: " . $_SESSION['username'];

            header("Location: ../index.php");
            exit();
        } 
        else {
            echo "Incorrect password. Please try again.";
        }
    } 
    else {
        echo "User not found. Please check your username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container mt-5">
        <a href="../index.php" class="btn btn-primary" style="position: absolute; top: 50px; left: 500px;">Go back to Home</a>
        <h2>Login Page</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
</body>
</html>
