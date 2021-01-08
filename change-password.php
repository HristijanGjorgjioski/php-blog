<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

  if(empty($_SESSION['user_id'])) {
    redirect("login.php");
  } 

  $user = User::find_by_id($_SESSION['user_id']);

  if(isset($_POST['submit'])) {
  	$password1 = $_POST['password1'];
  	$password2 = $_POST['password2'];

    if($password1 == $password2) {
      $user->password = md5($_POST['password2']);
      $user->save();
      redirect("profile.php");
      $session->message("Password changed successfuly");
  } else {
  	redirect("change-password.php");
  	$session->message("Passwords did not match. Try again");
  }
}
?>



<div class="container col-sm-8">
	<div class="row">
		<div class="col-sm-12">
			<h1>Change Password</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			<p class="text-center">Use the form below to change your password. Your password cannot be the same as your username.</p>
			<form method="post" id="passwordForm">
				<h3 class="text-danger"><?php echo $session->message; ?></h3>
				<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">
				<hr>	
				<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
				<hr>
				<input name="submit" type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
			</form>
		</div><!--/col-sm-6-->
	</div><!--/row-->
</div>

