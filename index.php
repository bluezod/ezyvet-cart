<?php
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
        <tr>
            <td><?php echo $product['name']?></td>
            <td><?php echo $product['price']?></td>
            <td><a href="#">Add</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<h1>Your Cart</h1>
<hr>
<h1>Total</h1>


<?php var_dump($products); ?>
