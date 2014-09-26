<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Views/__head.php");
include_once("$root/eshop/Controllers/cart_controller.php");
$result = $_SESSION['trans'];
$cart = $result['cart'];
$products = $result['products'];
$trans =1;
?>
<div class="container">
<h3>Invoice</h3>
<table class="table table-bordered">
<tr>
    <td class="col-md-6"><b>Product</b></td>
    <td class="col-md-3 center_element"><b>Price</b></td>
    <td class="col-md-1"><b>Quantity</b></td>
</tr>
<?php
foreach ($products as $product) {
?>
<tr>
    <td class="col-md-6"><?php echo $product->title; ?></td>
    <td class="col-md-4 center_element"><?php echo $product->item_price; ?></td>
    <td class="col-md-1 center_element"><?php echo $product->quantity; ?></td>
</tr>
<?php
}
?>
<tr>
    <td class="col-md-6"><b>Total Price</b></td>
    <td class="col-md-4 center_element bold"><b><?php echo $cart->total_price; ?></b></td>
</tr>
<tr>
    <td class="col-md-6"><b>Transaction time</b></td>
    <td class="col-md-4 center_element bold"><b><?php var_dump($cart->transaction_time); ?></b></td>
</tr>
</table>
</div>