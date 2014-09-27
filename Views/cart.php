<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Views/__head.php");
include_once("$root/eshop/Controllers/cart_controller.php");
$result = get_open_cart_action();
$_SESSION['trans'] = $result;
$cart = $result['cart'];
$products = $result['products'];
$trans = 0;
?>
<div class="container">
<?php
if($result == 0 || $cart->total_price == 0)
{
  $message = "<div class='alert alert-danger' role='alert'>You cart is empty</div>";
  echo $message;
?>


<?php
}
else
{

?>
<h3>My Shopping Cart</h3>
<?php
include_once("$root/eshop/Views/__cart_info.php");
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
  aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Checkout </h4>
      </div>
      <div class="modal-body">
          Confirm buying products in list with $<?php echo $cart->total_price; ?>?
      </div>
      <div class="modal-footer">
        <form name="buy" method="post" 
        action ="/eshop/Controllers/cart_controller.php">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" type="submit" name="buy_products" value="Yes"></input>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php
}
?>
