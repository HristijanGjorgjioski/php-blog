<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 

  if(empty($_SESSION['user_id'])) {
    redirect("login.php");
  } 

  $user = User::find_by_id($_SESSION['user_id']);

  if(isset($_POST['submit'])) {
    if($user) {
      $user->username = $_POST['username'];
      $user->email = $_POST['email'];
      $user->full_name = $_POST['full_name'];

      if(empty($_FILES['user_image'])) {
        $user->save();
        redirect("profile.php");
        $session->message("The user has been updated!");
      } else {
      $user->set_file($_FILES['user_image']);
      $user->upload_photo();
      $user->save();
      $session->message("The user with name of <b>'{$user->username}'</b> has been updated!");
      redirect("profile.php");        
      }
    }
  }
?>



<div class="container bootstrap snippets bootdeys w-100 main-edit-user">
<div class="row justify-content-center">
  <div class="col-xs-12 col-sm-12">
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
      <h3 class="text-success"><?php echo $session->message; ?></h3>
      <div class="form-group">
        <label for="user_image" class="control-label">Upload image</label>
        <input type="file" name="user_image">
      </div>

        <div class="panel panel-default">
          <div class="panel-body text-center">
           <img style="width: 400px; height: 300px" src="<?php echo $user->image_path_and_placeholder(); ?>" class="img-circle profile-avatar" alt="User avatar">
          </div>
        </div>

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Your profile info</h4>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-sm-1 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-1 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-1 control-label">FullName</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="full_name" value="<?php echo $user->full_name; ?>">
            </div>
          </div>
        
          <input type="submit" name="submit" class="btn btn-lg btn-primary edit-user-btn">
          <a class="float-right" href="change-password.php">Change password here</a>
        </div>
      </div>


    </form>
  </div>
</div>


</div>



