<?php
session_start();
include('connection.php');

// Initializing variables
$name = $email = $phone = $username = $password = $message = "";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizing and validate inputs
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    if (!preg_match('/^[a-zA-Zé\s-]+$/', $name)) {
        $errors["name"] = "Name must use only letters";
    }

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email must be a valid email address";
    }

    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors["phone"] = "Phone number must be a 10-digit number";
    }

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}$/', $username)) {
        $errors["username"] = "Username must have at least one uppercase letter, one lowercase letter, and one digit, and be at least 6 characters long";
    }

    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^A-Za-z0-9]).{7,}$/', $password)) {
        $errors["password"] = "Password must use at least one number, one uppercase letter, one lowercase letter, and one special character and be at least 7 characters long";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        $sql = "INSERT INTO Customers (Name, Email, Phone, Username, Password) 
                VALUES (?, ?, ?, ?, ?)";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $username, $hashedPassword]);

            $message = "Registration successful";
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}
?>

