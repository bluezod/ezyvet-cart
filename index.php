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
// Retrieve cart object stored in session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    // Init the cart object
    $cart = new Cart;
}
if (isset($_GET['cart_action'])) {
    $cartAction = $_GET['cart_action'];
    switch ($cartAction) {
        case 'add':
            break;
        case  'remove':
            break;
        default:
            break;
    }
    $_SESSION['cart'] = $cart;
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
<?php endif; ?>
<hr>
<h1>Overall Total</h1>
<?php
$totalAmount = 0;
if (!$cart->isEmpty()) {
    foreach ($cart->getItems() as $item) {
        $totalAmount += isset($item['row_total']) ? $item['row_total'] : 0;
    }
}
?>
The total amount of your cart is <strong><?php echo $totalAmount ?></strong>.
<?php var_dump($products); ?>
