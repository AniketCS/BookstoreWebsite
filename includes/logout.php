<?php
// Deleting the 'username' cookie.
setcookie('username', '', time() - 3600 * 24 * 365, '/');

header('Location: ../index.php');
?>
