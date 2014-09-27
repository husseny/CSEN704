<!-- Author: Mohab -->
<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Controllers/product_controller.php");
include_once("$root/eshop/Controllers/cart_controller.php");
include_once("$root/eshop/Views/__head.php");
$trans = 1;
$profile_info = get_profile_info($_GET['user_name']);
$user_reviews = get_reviews_for_user($profile_info->id);
?>
<div class="container">
	<div class="col-xs-3 personal_info">
		<div class="avatar-frame pull-right">
			<img src=<?php echo "/eshop/Assets/images/$profile_info->avatar_id.png" ?> 
				class="avatar img img-responsive" alt="">
			</div>
	</div>
	<div class="col-xs-9 reviews">
		<?php 
		include("$root/eshop/Views/__user_reviews.php");
		if ($profile_info->user_name == $_SESSION['user_name']){
			$results = get_transactions_action();
			include("$root/eshop/Views/__user_transactions.php");
		} ?>
	</div>
</div>
<?php include_once("$root/eshop/Views/__foot.php");
?>
