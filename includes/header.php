<?php
session_start();
if (isset($_SESSION['username'])) {
    $welcome_message = 'Welcome back ' . $_SESSION['username'];
    $logging_link = '<a href="includes/logout.php" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;">Log Out</a>';
    
    $visit_count_cookie_name = $_SESSION['username'] . '_visit_count';

    if (isset($_COOKIE[$visit_count_cookie_name])) {
        $visit_count = $_COOKIE[$visit_count_cookie_name];
    } else {
        $visit_count = 0;
    }
    $view_orders_link = '<a href="orders.php" class="btn btn-success btn-block">View Orders</a>';
} 
else {
    $logging_link = '<a href="includes/login.php" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;">Log In</a>';
    $visit_count = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bookstore Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron text-center bg-light">
        <?php
            echo $view_orders_link;
            ?>
