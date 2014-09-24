<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Models/users.php");

$users = users::get_instance();
if (isset($_POST['login_submit'])){
	login_action();
}else if (isset($_POST['logout_submit'])) {
	logout_action();
}else if (isset($_POST['register_submit'])){
	register_action();
}

function login_action(){
	global $users;
	$user = $users->verify($_POST['user_name'], $_POST['password']);
	if ($user) {
		$_SESSION['user_name'] = $user->user_name;
		$_SESSION['user_id'] = $user->id;
	}else {
		$_SESSION['login_error'] = "Wrong User Name or Password";
	}
		$new_path = "/eshop/Views/index.php";
		echo "<script> location.replace('$new_path'); </script>";
}


function register_action(){
	global $users;
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	$result = $users->add($first_name, $last_name, $user_name, $password);
	if ($result === "user exists") {
		$_SESSION['registration_fields'] = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'user_name' => $user_name);
		$_SESSION['registration_message'] = "User name already exists";
	}else {
		$_SESSION['registration_message'] = "Registered successfully";
		unset($_SESSION['registraion_message']);
		unset($_SESSION['registration_fields']);
	}
		$new_path = "/eshop/Views/index.php";
		echo "<script> location.replace('$new_path'); </script>";
	
}

function logout_action(){
	unset($_SESSION);
	session_destroy();
	$new_path = "/eshop/Views/index.php";
	echo "<script> location.replace('$new_path'); </script>";	
}
?>