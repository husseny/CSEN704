<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Views/__head.php");
include_once("$root/eshop/Controllers/cart_controller.php");
$cart = get_open_cart_action();
?>
<div class="container">
<?php
if($cart == 0)
{
	$message = "Your cart is empty";
	echo $message;
?>


<?php
}
else
{

?>
<table class="table table-hover">
  <tr>
    <td class="col-md-10">A</td>
    <td class="col-md-3">B</td>
    <td class="col-md-6">C</td>
    <td class="col-md-1">D</td>
</tr>
</table>
</div>
<?php
}
?>