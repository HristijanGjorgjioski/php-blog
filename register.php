<?php include("header.php"); ?>

<?php  

    if(isset($_POST['submit_reg'])) {
        $username = trim($_POST['reg_username']); 
        $email = trim($_POST['reg_email']);
        $full_name = trim($_POST['full_name']);
        $password = trim($_POST['reg_password']); 

        $hash = md5($password);

        $user_register = new User;
        $user_register->register_user($username, $email, $hash, $full_name);
        if($user_register) {
            redirect("login.php");
        } else {
            $the_message = "Your password or username are incorrect";
        }


    }   else {
        $username = "";
        $email = "";
        $password = "";
        $full_name = "";
        $the_message = "";
    }


?>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-12 col-md-6 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Register for Hristijan Blog <small>It's free!</small></h3>
                        </div>
                        <div class="panel-body">
                        <form role="form" method="post" action="register.php">
                            <div class="form-group">
                                <input type="text" name="reg_username" id="first_name" class="form-control input-sm" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control input-sm" placeholder="Full Name">
                            </div>

                            <div class="form-group">
                                <input type="email" name="reg_email" class="form-control input-sm" placeholder="Email Address">
                            </div>

                            <div class="form-group">
                                <input type="password" name="reg_password" class="form-control input-sm" placeholder="Password">
                            </div>
                            
                            <input type="submit" name="submit_reg" value="Register" class="btn btn-info btn-lg">
                            <h4>Alredy have an account? <a href="login.php">Login Here</a></h4>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

