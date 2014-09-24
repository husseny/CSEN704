<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Views/__head.php");

$profile_info = get_profile_info($_GET['user_name']);
$user_reviews = get_reviews_for_user($profile_info->id);

var_dump($profile_info);
var_dump($user_reviews);
?>
<?php include_once("$root/eshop/Views/__foot.php");
?>
