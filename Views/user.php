<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Views/__head.php");

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
		<section class="row">
			<h2>
			<?php 
			if ($profile_info->user_name == $_SESSION['user_name']){
				echo "My reviews";
			}else {
				echo ucwords($profile_info->first_name . " " . $profile_info->last_name) . "'s reviews:";
			}
			?>
			</h2>
			<?php 
			$reviews_count = (float) count($user_reviews);
			for ($i = 0; $i<$reviews_count; $i++){
				if ($i==0 || $i == ceil($reviews_count/2) ){
					echo "<div class='col-xs-6 reviews_col'>";
				}
				$output  = "<div class='bordered_section'>";
				$output .= "<div class='review_content'>";
				$output .= "<div class='product_thumbnail'>";
				$output .= "<img src='../Assets/images/product$i.jpg'>";
				$output .= "<span class='pull-left'> Star Fluxx The Ever Changing Card Game... In Space! Plus FREE Wooden Box! </span>";
				$output .= "</div>";
				for($j = 1; $j <= 5 ; $j++){
					if ($j <= $user_reviews[$i]->rate){
						$output.= "<i class='fa fa-star fa-lg star'></i>";
					}else{
						$output.= "<i class='fa fa-star fa-lg star_dull'></i>";
					}
				}
				$output .= "<p class='time_added'>" . substr($user_reviews[$i]->time_added, 0, 10) . "</p>";
				$output .= "<p>" .$user_reviews[$i]->comment ."</p></div>";
				$output .= "</div>";
				echo $output;
				if ($i == ceil($reviews_count/2) -1 || $i == $reviews_count -1) {
					echo "</div>";
				}
			} ?>
		</section>
				<section class="row">
			<h2>
			<?php 
			if ($profile_info->user_name == $_SESSION['user_name']){
				echo "My transactions";
			} ?>
		</section>
	</div>
</div>
<?php include_once("$root/eshop/Views/__foot.php");
?>
