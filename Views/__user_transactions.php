<section class="row">
	<h2>My transactions</h2>
	<?php 
	foreach ($results as $result) {
		$cart = $result['cart'];
		echo "<div class='transaction'>";
			$products = $result['products'];
			include("$root/eshop/Views/__cart_info.php");
		echo "</div>";
	} ?>
</section>
