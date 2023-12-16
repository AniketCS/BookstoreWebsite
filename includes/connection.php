<?php
include('includes/header.php');
?>

<body>
    <?php
    //details for connecting to db server
    $hostname = "db.cs.dal.ca";
    $username = "aniketm";
    $password = "Hf62uYsVNzQpuL6QgcdaeZMAQ";
    $database = "aniketm";

    //try and catch statements for making a connection and catching failed connection
    try {
        $dsn = "mysql:host=$hostname;dbname=$database";
        $pdo = new PDO($dsn, $username, $password);
        
        echo "Connection to the database works!";
    } 
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
