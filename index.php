<?php include("classes/init.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
  $items_per_page = 3;
  $items_total_count = Blog::count_all();

  $paginate = new Paginate($page, $items_per_page, $items_total_count);

  $sql = "SELECT * FROM blogs LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
  $blogs = Blog::find_by_query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog - Hristijan</title>
  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">   
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-center">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> 
              <li class="nav-item"><a class="nav-link" href="all-blogs.php">Blogs</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
              <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="add-blog.php">Add Blog</a></li> 
              <li class="nav-item"><a class="nav-link" href="components/logout.php"><i class="fa fa-sign-out"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li><a href="#"><i class="ti-facebook"></i></a></li>
              <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#"><i class="ti-instagram"></i></a></li>
              <li><a href="#"><i class="ti-skype"></i></a></li>
            </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->
  
  <main class="site-main">
    <!--================Hero Banner start =================-->  
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h3>Blogs & Stories</h3>
            <h1>The Best Blogs</h1>
            <h4><?php echo date("Y/m/d") ?></h4>
          </div>
        </div>
      </div>
    </section>
    <!--================Hero Banner end =================-->  

    <!--================ Blog slider start =================-->  
    <section>
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
    </section>
    <!--================ Blog slider end =================-->  

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">


            <?php foreach ($blogs as $blog) : ?>
            <div class="single-recent-blog-post">
              <div class="thumb">
                <img class="img-fluid" src="<?php echo $blog->picture_path(); ?>" alt="">
                <ul class="thumb-info">
                  <li><a href="#"><i class="ti-user"></i><?php $blog->author; ?></a></li>
                  <li><a href="#"><i class="ti-notepad"></i><?php echo $blog->time_added; ?></a></li>
                  <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                </ul>
              </div>
              <div class="details mt-20">
                <a href="blog-details.php?id=<?php echo $blog->id ?>">
                  <h3><?php echo $blog->title; ?></h3>
                </a>
                <p><?php echo $blog->description; ?></p>
                <a class="button" href="blog-details.php?id=<?php echo $blog->id ?>">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          <?php endforeach; ?>
            

          <div class="row">
      <ul class="pagination">

        <?php 
          
          if ($paginate->page_total() > 1) {

            if($paginate->has_next()) {
              echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
            }

            for ($i=1; $i <= $paginate->page_total(); $i++) { 
              if($i == $paginate->current_page) {
                echo "<li class='active strana'>
                    <a href='index.php?page={$i}'>
                      {$i}
                    </a>
                  </li>"
                ;
              } else {
                echo "<li>
                    <a href='index.php?page={$i} strana'>
                      {$i}
                    </a>
                  </li>"
                ;
              }
            }



            if($paginate->has_previous()) {
              echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
            }            
          }

        ?>

        <li class='previous'></li>
      </ul>
    </div>
            

           


          </div>

          <!-- Start Blog Post Siddebar -->
          <div class="col-lg-4 sidebar-widgets">
              <div class="widget-wrap">
                <div class="single-sidebar-widget newsletter-widget">
                  <h4 class="single-sidebar-widget__title">Newsletter</h4>
                  <div class="form-group mt-30">
                    <div class="col-autos">
                      <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'">
                    </div>
                  </div>
                  <button class="bbtns d-block mt-20 w-100">Subcribe</button>
                </div>
                  
                </div>
              </div>
            </div>
          <!-- End Blog Post Siddebar -->
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
  </main>

  <!--================ Start Footer Area =================-->
  <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              Hristijan Gjorgjioski
              hristijangorgioski501@gmail.com
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Hristijan Gjorgjioski</a>
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