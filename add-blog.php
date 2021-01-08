<?php include("header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php 

	$message = "";
	$date = date('Y-m-d H:i:s');
	if(isset($_FILES['file'])) { 

	$blog = new Blog();
	$blog->title = $_POST['title'];
	$blog->author = $_POST['author'];
	$blog->description = $_POST['description'];
	$blog->time_added = $date;
	$blog->set_file($_FILES['file']);

	if($blog->save()) {
		$message = "Blog {$blog->title} uploaded sucessfully"; 
		redirect("all-blogs.php");
	} else {
		$message = join("<br>", $blog->errors);
	}

}?>


<?php include("navigation.php"); ?>

<div id="page-wrapper" class="add-blog-main">


    <div class="container-fluid add-blog-second">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-8 add-blog-main" >
                <h1 class="page-header">
                    Create your new blog
                </h1>

                <div class="row">
                <div class="col-md-6">


                
                <form action="add-blog.php" method="post" enctype="multipart/form-data" class="add-blog-form">

                    <div class="form-group">
                        <input type="text" name="author" class="form-control" placeholder="Author">
                    </div>

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <textarea name="description" rows="10" class="form-control" aria-label="With textarea" placeholder="Blog Text"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="file" class="btn btn-lg btn-info">
                    </div>

                    <input type="submit" name="submit" value="Upload Blog" class="btn btn-lg btn-info" style="margin-bottom: 10px;">

                </form>



                </div>

            </div><!--End of Row-->

            <div class="row">
                <div class="col-lg-12">
                    <form action="upload.php" class="dropzone"></form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

  <?php include("footer.php"); ?>
