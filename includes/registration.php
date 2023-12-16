<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <?php
        include('registration_validation.php');

        if (!empty($message)) {
            echo "<p>$message</p>";
        }
        ?>
        <a href="../index.php" class="btn btn-primary" style="position: absolute; top: 10px; left: 100px;">Go back to Home</a>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required value="<?php echo htmlspecialchars($name); ?>">
                <?php if (isset($errors["name"])) echo "<p class='text-danger'>{$errors["name"]}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required value="<?php echo htmlspecialchars($email); ?>">
                <?php if (isset($errors["email"])) echo "<p class='text-danger'>{$errors["email"]}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" name="phone" id="phone" required value="<?php echo htmlspecialchars($phone); ?>">
                <?php if (isset($errors["phone"])) echo "<p class='text-danger'>{$errors["phone"]}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required value="<?php echo htmlspecialchars($username); ?>">
                <?php if (isset($errors["username"])) echo "<p class='text-danger'>{$errors["username"]}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <?php if (isset($errors["password"])) echo "<p class='text-danger'>{$errors["password"]}</p>"; ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
