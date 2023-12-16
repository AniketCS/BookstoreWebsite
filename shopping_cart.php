<?php
session_start();
include('includes/catalog.php');
include('includes/footer.php'); 
$cart = array();
$quantity = array(); 
$total = 0;

$cartItemCount = count($_SESSION['cart']);

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $isbn) {
        if (isset($quantity[$isbn])) {
            $quantity[$isbn]++; 
        } else {
            $quantity[$isbn] = 1; 
            foreach ($catalog as $genre => $products) {
                foreach ($products as $product) {
                    if ($product['isbn'] == $isbn) {
                        $cart[] = $product;
                    }
                }
            }
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['empty_cart'])) {
    // Clearing the cart by unsetting the cart session variable
    $_SESSION['cart'] = array();
    // Resetting the cart and quantity variables
    $cart = array();
    $quantity = array();
    $total = 0;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $isbn_to_remove = $_POST['remove_item'];
    if (isset($quantity[$isbn_to_remove])) {
        $total -= $cart[array_search($isbn_to_remove, array_column($cart, 'isbn'))]['price'];
        $quantity[$isbn_to_remove] = 0;
        $_SESSION['cart'] = array_diff($_SESSION['cart'], [$isbn_to_remove]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $isbn_to_update = $_POST['isbn'];
    $new_quantity = (int)$_POST['new_quantity'];

    if (isset($quantity[$isbn_to_update])) {
        $old_quantity = $quantity[$isbn_to_update];

        
        if ($new_quantity > $old_quantity) {
            // Increase in the quantity
            $quantity_difference = $new_quantity - $old_quantity;
            $_SESSION['cart'] = array_merge($_SESSION['cart'], array_fill(0, $quantity_difference, $isbn_to_update));
        } 
        elseif ($new_quantity < $old_quantity) {
            // Decrease in the quantity
            $quantity_difference = $old_quantity - $new_quantity;
            $keys = array_keys($_SESSION['cart'], $isbn_to_update);
            for ($i = 0; $i < $quantity_difference; $i++) {
                unset($_SESSION['cart'][$keys[$i]]);
            }
        }

        $quantity[$isbn_to_update] = max(0, $new_quantity);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase_order'])) {
    
    // Clearing the cart after purchase
    $_SESSION['cart'] = array();
    $cart = array();
    $quantity = array();
    $total = 0;
    
    header("Location: index.php");
    exit();
}


include('includes/header.php');
?>

<div class="container mt-5">
    <h1 class="text-center">Shopping Cart</h1>
    <p><?php echo "Total Number of Items in cart: $cartItemCount (reload page to get accurate number)"; ?></p>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Update</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $item): ?>
                <tr>
                    <td><?php echo $item['title']; ?></td>
                    <td><?php echo $item['author']; ?></td>
                    <td>$<?php echo $item['price'] * $quantity[$item['isbn']]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="isbn" value="<?php echo $item['isbn']; ?>">
                            <input type="number" name="new_quantity" value="<?php echo $quantity[$item['isbn']]; ?>" min="0">
                            <input type="submit" name="update_quantity" class="btn btn-primary" value="Update">
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="remove_item" value="<?php echo $item['isbn']; ?>">
                            <input type="submit" class="btn btn-danger" value="Remove (click twice)">
                        </form>
                    </td>
                </tr>
            <?php $total += $item['price'] * $quantity[$item['isbn']];
            endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total:</strong></td>
                <td><strong>$<?php echo $total; ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<a href="index.php" class="btn btn-primary" style="position: absolute; top: 10px; left: 100px;">Home/Continue Shopping</a>
<form action="" method="post">
    <input type="submit" name="empty_cart" class="btn btn-danger" style="position: absolute; top: 10px; right: 100px;" value="Empty Cart">
</form>

<form action="" method="post">
    <input type="submit" name="purchase_order" class="btn btn-success" style="position: absolute; top: 10px; right: 250px;" value="Purchase Order">
</form>
