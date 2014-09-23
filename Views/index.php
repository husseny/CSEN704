<?php session_start(); ?>
<html>
<head>
	<title>Log in</title>
</head>
<body>
<?php 
if (!isset($_SESSION['user_id'])){
	echo isset($_SESSION['login_error'])? $_SESSION['login_error'] : "";
	unset($_SESSION['login_error']);
?>
	<form name="login" method="post" action="/eshop/Controllers/user_controller.php">
		<input type="text" name="user_name"></input>
		<input type="password" name="password"></input>
		<input type="submit" name="login_submit" value="go"></input>
	</form>
<?php 
} else {
	echo "You have logged in correctly";
	var_dump($_SESSION);
?>
	<form name="logout" method="post" action ="/eshop/Controllers/user_controller.php">
		<input type="submit" name="logout_submit" value="logout"></input>
<?php 
} 
?>
</body>
</html>