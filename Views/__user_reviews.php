<!-- Author: Mohab -->
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