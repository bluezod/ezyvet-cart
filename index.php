<?php
session_start();
require_once("Cart.php");
/**
 * Created by PhpStorm.
 * User: bluezod
 * Date: 2018-12-11
 * Time: 21:15
 */
// ######## please do not alter the following code ########
$products = array(
    array("name" => "Sledgehammer", "price" => 125.75),
    array("name" => "Axe", "price" => 190.50),
    array("name" => "Bandsaw", "price" => 562.13),
    array("name" => "Chisel", "price" => 12.9),
    array("name" => "Hacksaw", "price" => 18.45)
);
// ##################################################
$success = false;
// Retrieve cart items array stored in session
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
} else {
    $cartItems = array();
}
// Init the cart object
$cart = new Cart($cartItems);
if (isset($_GET['cart_action']) && isset($_GET['product_name'])) {
    $cartAction = $_GET['cart_action'];
    $productName = $_GET['product_name'];
    switch ($cartAction) {
        case 'add':
            $unitPrice = 0;
            foreach ($products as $product) {
                if ($product['name'] == $productName) {
                    $unitPrice = $product['price'];
                    break;
                }
            }
            if ($unitPrice) {
                $success = $cart->add($productName, $unitPrice);
            }
            break;
        case  'remove':
            $success = $cart->remove($productName);
            break;
        default:
            break;
    }
    if ($success) {
        $_SESSION['cart'] = $cart->getItems();
    }
}
?>

<html>
<head>
    <title>ezyVet Cart</title>
</head>
<body>
<h1>List Products</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <form method="post" action="index.php?cart_action=add&product_name=<?php echo $product['name'] ?>">
            <tr>
                <td><?php echo $product['name'] ?></td>
                <td><?php echo number_format($product['price'], 2) ?></td>
                <td><input type="submit" value="Add"/></td>
            </tr>
        </form>
    <?php endforeach; ?>
</table>
<hr>
<h1>Your Cart</h1>
<?php if ($cart->isEmpty()) : ?>
    Your cart is empty. Please feed it with some products.
<?php else: ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cart->getItems() as $item): ?>
            <form method="post" action="index.php?cart_action=remove&product_name=<?php echo $item['name'] ?>">
                <tr>
                    <td><?php echo isset($item['name']) ? $item['name'] : '' ?></td>
                    <td><?php echo isset($item['unit_price']) ? number_format($item['unit_price'], 2) : '' ?></td>
                    <td><?php echo isset($item['qty']) ? $item['qty'] : '' ?></td>
                    <td><?php echo isset($item['row_total']) ? number_format($item['row_total'], 2) : '' ?></td>
                    <td><input type="submit" value="Remove"/></td>
                </tr>
            </form>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<hr>
<h1>Overall Total</h1>
The total amount of your cart is <strong><?php echo $cart->getOverallTotal() ?></strong>.
