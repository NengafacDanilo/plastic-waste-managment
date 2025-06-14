<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plastic-Waste-Management-Systemt</title>

  <!-- css -->
  <link rel="icon" href="asset/img/icon.png">
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <link href="asset/css/font-awesome.min.css" rel="stylesheet">
  <link href="asset/css/animate.css" rel="stylesheet">
  <link href="asset/css/services.css" rel="stylesheet">  <link rel="stylesheet" href="asset/css/vendor/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="asset/css/navigation.css">

  <!-- template skin -->
  <link id="t-colors" href="asset/css/color/default.css" rel="stylesheet">
  <link id="bodybg" href="asset/css/bodybg/bg1.css" rel="stylesheet" type="text/css" />

  
  <style>
  .bg-skin {
    background: #0062cc;
  }


  Navigation Styles
  .navigation {
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    padding: 10px 0;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  }

  .navbar-brand {
    font-family: 'IBM Plex Sans', sans-serif;
    padding: 0;
    margin-right: 50px;  /* Add space after the brand */
  }

  .navbar-brand h5 {
    color: white;
    margin: 0;
    display: flex;
    align-items: center;
  }

  .recycle-icon {
    margin-right: 10px;
    font-size: 24px;
  }

  /* Position nav items to the right */
  .navbar-collapse {
    display: flex;
    justify-content: flex-end;
  }

  /* Adjust nav items spacing */
  .navbar-nav {
    margin-right: 30rem;
    margin-left: auto;
  }

  .nav-item {
    margin: 0 10px;
  }

  .nav-link {
    color: white !important;
    font-family: 'IBM Plex Sans', sans-serif;
    transition: all 0.3s ease;
    padding: 8px 15px;
    display: flex;
    align-items: left;
  }

  .nav-link i {
    margin-right: 8px;
    font-size: 16px;
  
  }

  .nav-link:hover {
    opacity: 0.9;
    transform: translateY(-1px);
    
  }

  .navbar-toggler {
    border: none;
    padding: 0;
  }

  .navbar-toggler:focus {
    outline: none;
    box-shadow: none;
  }

  .hamburger-icon {
    width: 25px;
    height: 2px;
    background: white;
    position: relative;
    transition: all 0.3s ease;
  }

  .hamburger-icon:before,
  .hamburger-icon:after {
    content: '';
    position: absolute;
    width: 25px;
    height: 2px;
    background: white;
    left: 0;
    transition: all 0.3s ease;
  }

  .hamburger-icon:before {
    top: -8px;
  }

  .hamburger-icon:after {
    bottom: -8px;
  }

  /* Mobile Navigation */
  @media (max-width: 991.98px) {
    .navbar-collapse {
      background: rgba(57, 49, 175, 0.98);
      padding: 1rem;
      border-radius: 8px;
      margin-top: 0.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .nav-item {
      margin: 8px 0;
    }

    .nav-link {
      padding: 8px 15px;
      border-radius: 4px;
      text-decoration: none;
    }

    .nav-link:hover {
      background: rgba(255,255,255,0.1);
    }
  }

.btn-skin {
  background-color: #0062cc;
    border-color: #0062cc;
}
.box h4 {
    font-size: 24px;
    color: white;
    font-family: 'IBM Plex Sans', sans-serif;
}
.service-desc h5 {
    margin-bottom: 10px;
     color: white;
    font-family: 'IBM Plex Sans', sans-serif;
}
.fa-stethoscope:before {
  color: white;
}

.fa-h-square:before {
    color: white;
}

.fa-wheelchair:before {
    color: white;
}

.fa-filter:before {
    color: white;
}

.fa-plus-square:before {
    color: white;
}

.fa-user-md:before {
    color: white;
    background: #00ffff2b;
}

.fa-check:before {
    background: #084dbe;
}

.fa-list-alt:before {
    background: #005cd0;
}

.fa-hospital-o:before {
    background: #0eacf0de
}

.fa-heartbeat:before {
    color: white;
}

footer .widget h5 {
    font-size: 20px;
    margin-bottom: 10px;
    text-transform: uppercase;
    color: white;
}

.intro-content {
    /*background: url(../img/dummy/bg1.jpg) no-repeat top center;*/
    background:-webkit-linear-gradient(left, #3931af, #00c6ff);
    padding: 200px 0 60px;
}


</style>
</head>


<body>

  <!-- Navigation -->
  <div class="navigation">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <h5>
            <span class="recycle-icon">
              <i class="fa fa-recycle" aria-hidden="true"></i>
            </span>
            TRANSCYCLE
          </h5>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger-icon"></span>
          <span class="sr-only">Toggle navigation</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="login.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span class="nav-text">HOME</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="nav-text">ABOUT US</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact-form.php">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span class="nav-text">CONTACT</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>


  <div id="wrapper">

    <section id="intro" class="intro" style="font-family: 'IBM Plex Sans', sans-serif;">
      <div class="intro-content" style="padding-top: 75px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                <h2 style="font-family: 'IBM Plex Sans', sans-serif;color: white">TRANSCYCLE</h2>
              </div>
              <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                <h4 class="h-light" style="font-family: 'IBM Plex Sans', sans-serif;color: #efe1e1">Sustainable Plastic Waste Management Solutions</h4>
              </div>
              <div class="well well-trans" style="background:#ffffff00;color: white">
                <div class="wow fadeInRight" data-wow-delay="0.1s">

                  <ul class="lead-list">
                    <li><span class="fa fa-check-square-o fa-2x icon-success"></span> <span class="list"><strong>Easy Collection Scheduling</strong><br />Schedule convenient pickup times for your recyclable plastic waste</span></li>
                    <li><span class="fa fa-check-square-o fa-2x icon-success"></span> <span class="list"><strong>Reward-Based Recycling</strong><br />Earn points and rewards for your contributions to environmental sustainability</span></li>
                    <li><span class="fa fa-check-square-o fa-2x icon-success"></span> <span class="list"><strong>Impact Tracking</strong><br />Monitor your environmental impact through our detailed tracking system</span></li>
                  </ul>
                  <p class="text-right wow bounceIn" data-wow-delay="0.4s">
                    <a href="#" class="btn btn-skin btn-lg" style="background:white;color:#006ccf">Learn more <i class="fa fa-angle-right"></i></a>
                  </p>
                </div>
              </div>


            </div>
            <div class="col-lg-6">
              <div class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                <img src="asset/img/recyclable_3271305.png" class="img-responsive" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section id="boxes" class="home-section paddingtop-80" style="background: -webkit-linear-gradient(left, #3931af, #00c6ff);color: white;font-family: 'IBM Plex Sans', sans-serif;">

      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.3s">
              <div class="box text-center">

                <i class="fa fa-recycle fa-3x bg-skin"></i>
                <h4>Schedule Collection</h4>
                <p>Easy scheduling of plastic waste collection from your location</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.5s">
              <div class="box text-center">

                <i class="fa fa-list-alt fa-3x bg-skin"></i>
                <h4>Track Progress</h4>
                <p>Monitor your recycling history and environmental impact</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.7s">
              <div class="box text-center">
                <i class="fa fa-gift fa-3x bg-skin"></i>
                <h4>Earn Rewards</h4>
                <p>Get rewarded for your contribution to sustainable waste management</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">

            <div class="wow fadeInUp" data-wow-delay="0.9s">
              <div class="box text-center">

                <i class="fa fa-line-chart fa-3x bg-skin"></i>
                <h4>Impact Reports</h4>
                <p>View detailed reports of your recycling achievements</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>


    <section id="service" class="home-section nopadding paddingtop-60" style="background: -webkit-linear-gradient(left, #3931af, #00c6ff);color: white" style="height: 80%;">
      <div class="container">

        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="wow fadeInLeft" data-wow-delay="0.2s">
              <img src="asset/img/landing image.jpg" class="img-responsive" alt="" />
            </div>
          </div>
          <div class="col-sm-3 col-md-3">

            <div class="wow fadeInRight" data-wow-delay="0.1s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-recycle fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Waste Collection</h5>
                  <p>Scheduled pickup of sorted plastic waste from your location.</p>
                </div>
              </div>
            </div>

            <div class="wow fadeInRight" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-sort fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Waste Sorting</h5>
                  <p>Professional sorting of different types of plastic waste.</p>
                </div>
              </div>
            </div>
            <div class="wow fadeInRight" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-leaf fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Eco-friendly</h5>
                  <p>Sustainable practices for environmental protection.</p>
                </div>
              </div>
            </div>


          </div>
          <div class="col-sm-3 col-md-3">

            <div class="wow fadeInRight" data-wow-delay="0.1s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-line-chart fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Impact Tracking</h5>
                  <p>Monitor your contribution to environmental sustainability.</p>
                </div>
              </div>
            </div>

            <div class="wow fadeInRight" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-gift fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Rewards Program</h5>
                  <p>Earn points and rewards for your recycling efforts.</p>
                </div>
              </div>
            </div>
            <div class="wow fadeInRight" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <span class="fa fa-users fa-3x" style="color:#2ecc71"></span>
                </div>
                <div class="service-desc">
                  <h5 class="h-light">Community Impact</h5>
                  <p>Join our growing community of eco-conscious recyclers.</p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </section>

     <footer style="background: -webkit-linear-gradient(left, #3931af, #00c6ff);color: #e4d6d6">

      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>About Transcycle</h5>
                <p>
                  A modern plastic waste management platform dedicated to creating a sustainable future through efficient recycling solutions and community engagement.
                </p>
              </div>
            </div>
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Information</h5>
                <ul>
                  <li><a style="color: #e4d6d6" href="#">Home</a></li>
                  <li><a style="color: #e4d6d6" href="#">Collection Points</a></li>
                  <li><a style="color: #e4d6d6" href="#">Recycling Guide</a></li>
                  <li><a style="color: #e4d6d6" href="#">Rewards Program</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>TRANSCYCLE </h5>
                <p>
                  Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
                </p>
                <ul>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
                    </span> Monday - Saturday, 8am to 10pm
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                    </span> +237 672479163
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                    </span> transcycle@gmail.com
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Contact Transcycle</h5>
                <p>Your partner in sustainable plastic waste management</p>
                <ul>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
                    </span> Available 24/7
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                    </span> +237 XXX XXX XXX
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                    </span> contact@transcycle.com
                  </li>
                </ul>
              </div>
            </div>
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Our location</h5>
                <p>Buea, South West Region, Cameroon</p>

              </div>
            </div>
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Follow us</h5>
                
                <ul class="company-social">
                  <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                  <li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </footer>


  </div>


  <!-- Core JavaScript Files -->
  <script src="asset/js/jquery.min.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/jquery.easing.min.js"></script>
  <script src="asset/js/wow.min.js"></script>
  <script src="asset/js/jquery.scrollTo.js"></script>
  <script src="asset/js/jquery.appear.js"></script>
  <script src="asset/js/stellar.js"></script>
  <script src="asset/js/owl.carousel.min.js"></script>
  <script src="asset/js/nivo-lightbox.min.js"></script>
  <script src="asset/js/custom.js"></script>
</body>

</html>