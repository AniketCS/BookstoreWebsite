<?php 
session_start();
?>
<?= $logging_link ?>
<a href="shopping_cart.php" class="btn btn-primary" style="position: absolute; top: 10px; right: 100px;">Shopping Cart</a>
<?php if (isset($welcome_message)) : ?>
    <p><?= $welcome_message ?></p>
    <a href="profile.php" class="btn btn-warning btn-block" style="position: absolute; top: 10px; left: 10px;">View Profile</a>

<?php else : ?>
    <a href="includes/registration.php" class="btn btn-warning btn-block" style="position: absolute; top: 10px; left: 10px;">Register</a>
    <h1 class="display-4">Welcome to Our Bookstore</h1>
<?php endif; ?>

<p class="lead">Choose a genre:</p>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Children's Books</h5>
                <a href="children.php" class="btn btn-primary btn-block">Explore</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Educational Books</h5>
                <a href="educational.php" class="btn btn-success btn-block">Explore</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Puzzle Books</h5>
                <a href="puzzles.php" class="btn btn-warning btn-block">Explore</a>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html>
