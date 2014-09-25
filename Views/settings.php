<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/eshop/Controllers/user_controller.php");
include_once("$root/eshop/Views/__head.php");

$profile_info = get_profile_info($_SESSION['user_name']);
 ?>
<div class="container">
	<div class="col-xs-3">
		<div class="settings_tabs">
			<ul class="nav nav-tabs nav-pills nav-stacked" role="tablist">
				<li class="Active list_title"><a>Settings</a></li>
				<li class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
				<li><a href="#password" role="tab" data-toggle="tab">Password</a></li>
				<li><a href="#avatar" role="tab" data-toggle="tab">Avatar</a></li>
			</ul>
		</div>
	</div>
	<div class="col-xs-9 settings_page">
		<!-- Tab panes -->
		<div class="tab-content">
			<?php if (isset($_SESSION['update_message'])){
				echo $_SESSION['update_message'];
				unset($_SESSION['update_message']);
			} ?>
			<div class="tab-pane fade in active" id="profile">
				<form method="post" class="navbar-form" action="/eshop/Controllers/user_controller.php">
					<div class="form-group">
						<p>First name</p><input class="form-control" type="text" name="edits[first_name]" value=<?php echo $profile_info->first_name ?>></input>
						<p>Last name</p><input class="form-control" type="text" name="edits[last_name]" value=<?php echo $profile_info->last_name ?>></input>
						<p>User name</p><input class="form-control" type="text" name="edits[user_name]" value=<?php echo $profile_info->user_name ?>></input>					
						<br>
						<br>
						<input type="submit" value="Update" class="btn btn-success" name="edit_profile"></input>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="password">
				<form method="post" class="navbar-form" action="/eshop/Controllers/user_controller.php">
					<div class="form-group">
						<p>Old password</p><input class="form-control" type="password" name="old_password"></input>
						<p>New password</p><input class="form-control" type="text" name="new_password"></input>
						<br>
						<br>
						<input type="submit" value="Update" class="btn btn-success" name="edit_password"></input>
					</div>
				</form>
			</div>
			<?php $avatar_ids = $users->get_info('true', 'avatar_id'); ?>
			<div class="tab-pane fade" id="avatar">
				<form method="post" class="form-group" action="/eshop/Controllers/user_controller.php">
					<ul class="avatar_list row">
						<?php 
						$avatars_count = 3;
						for($i = 0; $i <= $avatars_count; $i++){
							if($i == 0 || $i == ceil($avatars_count/2)){ ?>
								<div class='<?php echo"col-xs-4 col$i" ?>'>
							<?php } ?>
							<li>
							<input id=<?php echo "avatar$i" ?> type="radio" name="avatar_id" value=<?php echo $i ?>></input>
							<label for=<?php echo "avatar$i"?> >
								<img class ="select_avatar" src=<?php echo "/eshop/Assets/images/$i.png" ?>>
							</label>
							</li>
							<?php if ($i == ceil($avatars_count/2)-1 || $i == $avatars_count){ ?>
								</div>
							<?php } ?>
						<?php } ?>
					</ul>
					<br>
					<br>
					<input type="submit" value="Update" class="btn btn-success" name="edit_avatar"></input>
				</form>
			</div>
		</div>
	</div>
</div>
