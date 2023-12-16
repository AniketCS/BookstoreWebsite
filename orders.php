<?php
include('includes/connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    $orderIDToUpdate = $_POST['order_id'];
    $newQuantity = $_POST['new_quantity'];
    $newISBN = $_POST['new_isbn'];

    // Checking if the order was made within the week
    $sqlCheckDate = "SELECT OrderDate FROM Orders WHERE OrderID = :orderID";
    $stmtCheckDate = $pdo->prepare($sqlCheckDate);
    $stmtCheckDate->bindParam(':orderID', $orderIDToUpdate, PDO::PARAM_INT);
    $stmtCheckDate->execute();
    $orderDate = $stmtCheckDate->fetchColumn();

    $orderDate = new DateTime($orderDate);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($orderDate);
    $daysDiff = $interval->days;

    if($daysDiff<=7) {
        // Updating order
        $sqlUpdateOrder = "UPDATE OrderDetails SET Quantity = :newQuantity, BookISBN = :newISBN WHERE OrderID = :orderID";
        $stmtUpdateOrder = $pdo->prepare($sqlUpdateOrder);
        $stmtUpdateOrder->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
        $stmtUpdateOrder->bindParam(':newISBN', $newISBN, PDO::PARAM_STR);
        $stmtUpdateOrder->bindParam(':orderID', $orderIDToUpdate, PDO::PARAM_INT);
        $stmtUpdateOrder->execute();

        echo "Order updated successfully!";
    } 
    else{
        echo "Sorry, the order is too old to update.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $orderIDToDelete = $_POST['order_id'];

   
    $sqlCheckDate = "SELECT OrderDate FROM Orders WHERE OrderID = :orderID";
    $stmtCheckDate = $pdo->prepare($sqlCheckDate);
    $stmtCheckDate->bindParam(':orderID', $orderIDToDelete, PDO::PARAM_INT);
    $stmtCheckDate->execute();
    $orderDate = $stmtCheckDate->fetchColumn();

    $orderDate = new DateTime($orderDate);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($orderDate);
    $daysDiff = $interval->days;

    if ($daysDiff<= 7) {
        // Deleting order
        $sqlDeleteOrder = "DELETE FROM Orders WHERE OrderID = :orderID";
        $stmtDeleteOrder = $pdo->prepare($sqlDeleteOrder);
        $stmtDeleteOrder->bindParam(':orderID', $orderIDToDelete, PDO::PARAM_INT);
        $stmtDeleteOrder->execute();

    
        $sqlDeleteOrderDetails = "DELETE FROM OrderDetails WHERE OrderID = :orderID";
        $stmtDeleteOrderDetails = $pdo->prepare($sqlDeleteOrderDetails);
        $stmtDeleteOrderDetails->bindParam(':orderID', $orderIDToDelete, PDO::PARAM_INT);
        $stmtDeleteOrderDetails->execute();

        echo "Order deleted successfully!";
    } 
    else{
        echo "Sorry, the order is too old to delete.";
    }
}

// SELECT statement to retrieve orders and their details
$sql = "SELECT Orders.OrderID, Orders.OrderDate, OrderDetails.BookISBN, OrderDetails.Quantity, OrderDetails.Subtotal
        FROM Orders
        JOIN OrderDetails ON Orders.OrderID = OrderDetails.OrderID";

$result = $pdo->query($sql);

if ($result) {
    echo '<a href="index.php" class="btn btn-primary">Go back to Home</a>';
    echo "<h2>Orders and Details</h2>";
    echo "<table border='1'>
            <tr>
                <th>OrderID</th>
                <th>OrderDate</th>
                <th>ISBN</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>";

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['OrderID']}</td>
                <td>{$row['OrderDate']}</td>
                <td>{$row['BookISBN']}</td>
                <td>{$row['Quantity']}</td>
                <td>{$row['Subtotal']}</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='order_id' value='{$row['OrderID']}'>
                        <label for='new_quantity'>New Quantity:</label>
                        <input type='number' name='new_quantity' value='{$row['Quantity']}' required>
                        <label for='new_isbn'>New ISBN:</label>
                        <input type='text' name='new_isbn' value='{$row['BookISBN']}' required>
                        <button type='submit' name='update_order' class='btn btn-warning'>Update</button>
                    </form>
                </td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='order_id' value='{$row['OrderID']}'>
                        <button type='submit' name='delete_order' class='btn btn-danger'>Delete</button>
                    </form>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    // Handling query error
    echo "Error executing query: " . $pdo->errorInfo()[2];
}

$pdo = null;
?>
