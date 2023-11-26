<?php 
session_start();
include('includes/catalog.php');


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $_SESSION['cart'][] = $product_id;
  
}


$cartItemCount = count($_SESSION['cart']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Puzzle Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="index.php" class="btn btn-primary" style="position: absolute; top: 10px; left: 100px;">Home</a>
    <a href="shopping_cart.php" class="btn btn-primary" style="position: absolute; top: 10px; right: 100px;">Shopping Cart</a>
        <h1 class="text-center">Puzzle Books</h1>
        <p><?php echo "Total Number of Items in cart: $cartItemCount"; ?></p>

<?php if (isset($_SESSION['cart_message'])): ?>
    <p><?php echo $_SESSION['cart_message']; ?></p>
    <?php unset($_SESSION['cart_message']); ?>
<?php endif; ?>
        <ul class="list-group">
            <?php if (isset($_SESSION['cart_message'])): ?>
                <p><?php echo $_SESSION['cart_message']; ?></p>
                <?php unset($_SESSION['cart_message']); ?>
            <?php endif; ?>
            <?php foreach ($catalog['puzzles'] as $book): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="images/<?php echo $book['cover_image']; ?>" alt="<?php echo $book['title']; ?>" class="img-fluid">
                        </div>
                        <div class="col-md-9">
                            <h2><?php echo $book['title']; ?></h2>
                            <p>Author: <?php echo $book['author']; ?></p>
                            <p>Price: $<?php echo $book['price']; ?></p>
                            <p>ISBN: <?php echo $book['isbn']; ?></p>
                            <p>Publication Year: <?php echo $book['year']; ?></p>
                            <p>Genres: <?php echo implode(', ', $book['genres']); ?></p>
                        </div>
                        <div class="col-md-3">
                            <form action="puzzles.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $book['isbn']; ?>">
                                <input type="hidden" name="genre" value="children">
                                <input type="submit" value="Buy" class="btn btn-dark">
                            </form>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
