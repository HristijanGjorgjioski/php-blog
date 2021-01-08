<?php include("header.php"); ?>
<?php include("navigation.php"); ?>

<?php 

  if(empty($_GET['id'])) {
    redirect("all-blogs.php");
  }

  $blog = Blog::find_by_id($_GET['id']);
  $user = User::find_by_id($_SESSION['user_id']);

  if(isset($_POST['submit'])) {
  $author = trim($_POST['author']);
  $body = trim($_POST['body']);

  $new_comment = Comment::create_comment($blog->id, $author, $body);

  if($new_comment && $new_comment->save()) {
    redirect("blog-details.php?id={$blog->id}");
  } else {
    $message = "There was some problem saving";
  }
} else {
  $author = "";
  $body = "";
}

$comments =  Comment::find_the_comments($blog->id);
?> 
  
  <!--================ Hero sm Banner start =================-->      
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1>Blog details</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Hristijan Gjorgjioski</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--================ Hero sm Banner end =================-->    


  

  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
            <div class="main_blog_details">
                <img class="img-fluid" src="<?php echo $blog->picture_path(); ?>" alt="">
                <a href="#"><h4><?php echo $blog->title; ?></h4></a>
                <div class="user_details">
                  <div class="float-left">
                    <a href="#">Lifestyle</a>
                    <a href="#">Gadget</a>
                  </div>
                  <div class="float-right mt-sm-0 mt-3">
                    <div class="media">
                      <div class="media-body">
                        <h5><?php echo $blog->author; ?></h5>
                        <p><?php echo $blog->time_added; ?></p>
                      </div>
                      <div class="d-flex">
                        <img width="42" height="42" src="<?php echo $blog->picture_path(); ?>" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <p><?php echo $blog->description; ?></p>
                
               <div class="news_d_footer flex-column flex-sm-row">
                 <a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4 people like this</a>
                 <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><span class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>06 Comments</a>
                 <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
               <a href="#"><i class="fab fa-facebook-f"></i></a>
               <a href="#"><i class="fab fa-twitter"></i></a>
               <a href="#"><i class="fab fa-dribbble"></i></a>
               <a href="#"><i class="fab fa-behance"></i></a>
             </div>
               </div>
              </div>
          
                



              <div class="wall">
                    <h4>Leave a Comment</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="text" name="author" class="form-control" placeholder="Author">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3" placeholder="Your Comment"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
              
                    <hr>
                    <?php foreach ($comments as $comment) : ?>
                  <!-- Comment -->
                  <div class="media" style="margin-top: 10px;">
                      <a class="pull-left" href="#">
                          <img class="media-object" style="width: 60px; height: 60px" src="images/<?php echo $user->user_image; ?>" alt="">
                      </a>
                      <div class="media-body">
                          <h4 class="media-heading"><?php echo $comment->author ?>
                          </h4>
                          <?php echo $comment->body; ?>
                      </div>
                  </div>
                <?php endforeach; ?>
              </div>


  </section>
  <!--================ End Blog Post Area =================-->

  <!--================ Start Footer Area =================-->
  <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
              magna aliqua.
            </p>
          </div>
        </div>
        <div class="col-lg-4  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Newsletter</h6>
            <p>Stay update with our latest</p>
            <div class="" id="mc_embed_signup">

              <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get" class="form-inline">

                <div class="d-flex flex-row">

                  <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                    required="" type="email">


                  <button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
                  <div style="position: absolute; left: -5000px;">
                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                  </div>

                  <!-- <div class="col-lg-4 col-md-4">
                        <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                      </div>  -->
                </div>
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget mail-chimp">
            <h6 class="mb-20">Instragram Feed</h6>
            <ul class="instafeed d-flex flex-wrap">
              <li><img src="img/instagram/i1.jpg" alt=""></li>
              <li><img src="img/instagram/i2.jpg" alt=""></li>
              <li><img src="img/instagram/i3.jpg" alt=""></li>
              <li><img src="img/instagram/i4.jpg" alt=""></li>
              <li><img src="img/instagram/i5.jpg" alt=""></li>
              <li><img src="img/instagram/i6.jpg" alt=""></li>
              <li><img src="img/instagram/i7.jpg" alt=""></li>
              <li><img src="img/instagram/i8.jpg" alt=""></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Follow Us</h6>
            <p>Let us be social</p>
            <div class="footer-social d-flex align-items-center">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-dribbble"></i>
              </a>
              <a href="#">
                <i class="fab fa-behance"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </footer>
  <!--================ End Footer Area =================-->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>