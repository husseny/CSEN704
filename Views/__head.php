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
	<div class="navbar navbar-default">
		<a class="navbar-brand" href="/eshop/">eShop</a>
		<div class="form-group">
	<?php
	if (!isset($_SESSION['user_id'])){
	?>
			<form class="navbar-form pull-right" name="login" method="post" action="/eshop/Controllers/user_controller.php">
				<input type="text" name="user_name"></input>
				<input type="password" name="password"></input>
				<input class="login btn btn-default" type="submit" name="login_submit" value="log in"></input>
			</form>
				 <button class="btn btn-default pull-right" data-toggle="modal" data-target="#registerModal">
 		Create Account
		</button>
		<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Create New Account</h4>
			      </div>
			      <div class="modal-body">
					<form name="register" method = "post" action = "/eshop/Controllers/user_controller.php" >
						<p>first name</p><input type="text" name="first_name"
						value = <?php 
							if (isset($_SESSION['registration_fields']['first_name']))
								echo $_SESSION['registration_fields']['first_name'];
						?> ></input>
						<p>last name</p><input type="text" name="last_name"
						value = <?php 
							if (isset($_SESSION['registration_fields']['last_name']))
								echo $_SESSION['registration_fields']['last_name'];
						?> ></input>
						<p>user name</p><input type="text" name="user_name"
						value = <?php 
							if (isset($_SESSION['registration_fields']['user_name']))
								echo $_SESSION['registration_fields']['user_name'];
						?> ></input>
						<p>password</p><input type="password" name="password"></input>
			      </div>
			      <div class="modal-footer">
						<input type="submit" name="register_submit" value="Done">
					</form>					
			      </div>
			    </div>
			  </div>			
		</div>
	<?php 
	} else {
	?>
		<form name="logout" method="post" action ="/eshop/Controllers/user_controller.php">
			<input class="login btn btn-default pull-right" type="submit" name="logout_submit" value="logout"></input>
		</form>
		<?php $user_name = $_SESSION['user_name'] ?>
		<a class="btn btn-default pull-right" href=<?php echo "/eshop/Views/user.php?user_name=$user_name" ?>>
			<?php echo $user_name ?>
		</a>
		<a class="btn btn-default pull-right" href="/eshop/Views/settings.php"><i class="fa fa-cog"></i></a>
		<a class="btn btn-default pull-right" href="/eshop/Views/cart.php">My Cart</a>
	<?php 
	}
	?>
		</div>
	</div>
<?php 
	if (isset($_SESSION['login_error'])) {
		echo "<div class='alert alert-danger' role='alert'>";
		echo $_SESSION['login_error'];
		echo "</div>";
		unset($_SESSION['login_error']);
	}
	if (isset($_SESSION['registration_message'])){
		echo "<div class='alert alert-warning' role='alert'>";
		echo $_SESSION['registration_message'];
		echo "</div>";
		unset($_SESSION['registration_message']);
	}
 ?>