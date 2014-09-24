<?php
@session_start();
?>
<html>
<head>
	<title>eShop</title>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/eshop/Assets/css/bootstrap.css">
	<link rel="stylesheet" href="/eshop/Assets/css/style.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="/eshop/Assets/js/jquery.js"></script>
	<script src="/eshop/Assets/js/bootstrap.js"></script>
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
		<hr>
		<?php 
			echo isset($_SESSION['registration_message'])? $_SESSION['registration_message'] : "";
		 ?>
		<form name="register" method = "post" action = "/eshop/Controllers/user_controller.php" >
			<p>first name :</p><input type="text" name="first_name"
			value = <?php 
				if (isset($_SESSION['registration_fields']['first_name']))
					echo $_SESSION['registration_fields']['first_name'];
			?> ></input>
			<p>last name :</p><input type="text" name="last_name"
			value = <?php 
				if (isset($_SESSION['registration_fields']['last_name']))
					echo $_SESSION['registration_fields']['last_name'];
			?> ></input>
			<p>user name :</p><input type="text" name="user_name"
			value = <?php 
				if (isset($_SESSION['registration_fields']['user_name']))
					echo $_SESSION['registration_fields']['user_name'];
			?> ></input>
			<p>password :</p><input type="text" name="password"></input>
			<input type="submit" name="register_submit" value="register">
		</form>
		<hr>
	<?php 
	} else {
	?>
		<form name="logout" method="post" action ="/eshop/Controllers/user_controller.php">
			<input type="submit" name="logout_submit" value="logout"></input>
	<?php 
	}
	?>