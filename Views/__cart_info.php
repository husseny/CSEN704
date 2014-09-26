<table class="table table-hover">
<tr>
    <td class="col-md-6"><b>Product</b></td>
    <td class="col-md-3 center_element"><b>Price</b></td>
    <td class="col-md-3 center_element"><b>Discount</b></td>
    <td class="col-md-1"><b>Quantity</b></td>
    <td class="col-md-1 center_element"></td>
    <td class="col-md-1 center_element"></td>
</tr>
<?php
foreach ($products as $product) {
?>
<tr>
    <td class="col-md-6"><?php echo $product->title; ?></td>
    <td class="col-md-4 center_element"><?php echo $product->price; ?></td>
    <td class="col-md-4 center_element"><?php echo $product->discount . "%"?></td>
    <form name="quantity" method="post" action ="/eshop/Controllers/cart_controller.php">
        <td class="col-md-1 center_element">
            <input name="quantity" type="text" class="form-control quantity_width" 
                placeholder="<?php echo $product->quantity; ?>"></input>
            <input name="product" type="hidden" value="<?php echo $product->id; ?>"></input>
            
        </td>
    <td class="col-md-1 center_element"><input class="login btn btn-default pull-right" 
        type="submit" name="edit_quantity" value="update"></input></td></form>
    <form name="quantity" method="post" action ="/eshop/Controllers/cart_controller.php">
        <input name="product" type="hidden" value="<?php echo $product->id; ?>"></input>
    <td class="col-md-1 center_element"><input class="login btn btn-default pull-right" 
        type="submit" name="delete_item" value="delete"></input></td></form>
</tr>
<?php
}
?>
<tr>
    <td class="col-md-6"><b>Total Price</b></td>
    <td class="col-md-4 center_element bold"><b><?php echo $cart->total_price; ?></b></td>
    <td></td>
    <td class="col-md-1 "><?php if($trans == 0){ ?><form name="clear" method="post" 
        action ="/eshop/Controllers/cart_controller.php">
            <input class="btn btn-danger btn-lg" type="submit" name="clear_products" value="Clear Cart"></input>
        </form><?php } ?></td>
    <td class="col-md-1 "><?php if($trans == 0){ ?><button class="btn btn-primary btn-lg" 
        data-toggle="modal" data-target="#myModal">
        Checkout
        </button<?php } ?></td>
    <td class="col-md-1 center_element"></td>
</tr>
</table>