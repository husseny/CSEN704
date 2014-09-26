<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Views/__head.php");
?>
<div class="container">
	<div class="row">
		<div class="categories">
			<ul class="nav nav-tabs nav-pills" role="tablist">
				<li><a roel="tab" data-toggle="rab" href="#Electronics">Electronics</a></li>
				<li><a roel="tab" data-toggle="rab" href="#Art">Art</a></li>
				<li><a roel="tab" data-toggle="rab" href="#Games">Games</a></li>
				<li><a roel="tab" data-toggle="rab" href="#Sport">Sport</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="tab-content">
	<?php 
	$categories = ['Electronics', 'Art', 'Games', 'Sport'];
	foreach($categories as $category){
		echo "<div class='tab-pane fade in active' id=$query>";
			get_products_by_category($category);
		echo "</div>";
	} ?>
</div>