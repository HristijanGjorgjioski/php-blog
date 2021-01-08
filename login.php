<?php require_once("header.php"); ?>


<?php  

	if($session->is_signed_in()) {
		redirect("index.php");
	}

	if(isset($_POST['submit_login'])) {
		$username = trim($_POST['login_username']); 
		$password = trim($_POST['login_password']); 

		$hash = md5($password);

		$user_found = User::verify_user($username, $hash);
	
		if($user_found) {
			$session->login($user_found);
			redirect("index.php");
		} else {
            redirect("login.php");
			$session->message("Your password or username are incorrect");
		}


	}	else {
		$username = "";
		$password = "";
		$the_message = "";
	}


?>


<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-12 col-md-6 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Login for Hristijan Blog</h3>
                        <h3 class="text-danger"><?php echo $session->message; ?></h3>
                        </div>
                        <div class="panel-body">

                        <form role="form" method="post" action="" id="login-id">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                            <input type="text" name="login_username" id="first_name" class="form-control input-sm" placeholder="Username">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <input type="password" name="login_password" id="password" class="form-control input-sm" placeholder="Password">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <input type="submit" name="submit_login" value="Login" class="btn btn-info btn-block">
                            <h4>Not a member yet? <a href="register.php">Register Here</a></h4>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

