<?php include("header.php"); ?>
<?php include("navigation.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php  
$blogs = Blog::find_all();


?>


<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
            Blogs
        </h1>

        <p class="bg-success"><?php echo $message; ?></p>
         
        <div class="col-md-12">

          
          

          <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
          

          <?php foreach ($blogs as $blog) : ?>
              <div class="card blog__slide text-center blog-thumbnail">
			    <div class="blog__slide__img">
			      <a href="blog-details.php?id=<?php echo $blog->id ?>"><img class="card-img rounded-0" src="<?php echo $blog->picture_path(); ?>" alt=""></a>
			    </div>
			    <div class="blog__slide__content">
			      <h3><a href="blog-details.php?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
			      <p><?php echo $blog->time_added; ?></p>
			    </div>
			  </div>
          <?php endforeach; ?>
          
          
          </div>
        </div>
      </div>
           

        </div>

      </div>
    </div>
  </div>
</div>
