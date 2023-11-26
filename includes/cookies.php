<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    // Setting a cookie with the username. Cookie expires in 1 year.
    setcookie('username', $username, time() + 3600 * 24 * 365, '/');

    
    $visit_count_cookie_name = $username . '_visit_count';
    
    if (isset($_COOKIE[$visit_count_cookie_name])) {
        $visit_count = $_COOKIE[$visit_count_cookie_name] + 1;
    } else {
        $visit_count = 1;
    }
    // Set a cooking with visit count for  user.Cookie expires in 1 year.
    setcookie($visit_count_cookie_name, $visit_count, time() + 3600 * 24 * 365, '/'); 
}

header('Location: ../index.php');


?>
