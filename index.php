<?php
  require 'config/config.php';
  $data = [];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BrokersBunch</title>
    <link rel = "icon" type = "image/png" href = "titlelogo.png" height="10px">

    <!-- Bootstrap core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="assets/css/rent.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/chat.css" rel="stylesheet">
		<link href="assets/css/testimonials.css" rel="stylesheet">


    <!-- loader files-->
     <link rel="stylesheet" href="assets/css/loaderstyle.css">

    
  </head>
<!-- chat message-->

  <body id="page-top">
  <button class="open-button" onclick="openForm()"><img  class="icon" src="msg.png" height="55 " width="55" align="middle" /></button>

<div class="chat-popup stylefont" id="myForm" >
  <form action="/action_page.php" class="form-container">
    <label for="msg"> <font color="white"><b>Send a Message</b></font></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"  id="mainNav">
      <div class="container">
<a class="navbar-brand js-scroll-trigger" href="#page-top"> 
<img src="finallogo.png" height="5%" width="40%" border=solid>
</a>
 <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
           
           
            
            <?php 
              if(empty($_SESSION['username'])){
                echo '<li class="nav-item">';
                  echo '<a class="nav-link " href="./auth/login.php" >Login</a>';
                echo '</li>';
              }else{
                echo '<li class="nav-item">';
                 echo '<a class="nav-link " href="./auth/dashboard.php" >Home</a>';
               echo '</li>';
              }
            ?>
            

            <li class="nav-item">
              <a class="nav-link" href="./auth/register.php" >Sign up</a>
            </li>

              
             <li class="nav-item">
              <a class="nav-link" href="./app/about.php" >About Us </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>


     <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <!-- Header -->

    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in" style="color: black"><br>Welcome To BrokersBunch!</div>
          <div class="intro-heading text-uppercase" style="color: black">Search &nbsp See &nbsp Live  <br></div>
        </div>
      </div>
    



 <!-- Testimonials -->
 
 
    <section id="search">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase"><br><font color="white" family="Montserrat">
              <div class="feedbox"><center><b>Feedbacks </b></center></div></font><hr style="border-top: dashed 5px;" width="300" color="Black"; /></h2>
          </div>
        </div>
     </div>
<div class="slideshow-container">

<div class="mySlides ">
  <div class="numbertext"><b>1 / 3</b></div>
  <br>
  <div class="text"><q><b>
  Presently, I am living in Bangalore and soon I will Shift to my own flat which I have booked under BrokersBunch. In beginning, I met with many builders and went their actual sites. Some offered luxuriant apartments but the price were high. Some societies were under construction and there was no idea about the possession. After scrutiny and market research, I booked the flat under BrokersBunch. Their societies drenched with lush of greenery and provide the eco friendly environment. I am glad on my decision. </q></b><br><br>
 <p class="author">- Johnny Keats (Real estate agent)</p>
 </div>
</div>

<div class="mySlides ">
  <div class="numbertext"><b>2 / 3</b></div>
  <br>
  <div class="text"> <q><b>
 I wanted to buy our home in Delhi, but the price of properties has been skyrocketed every year. Meanwhile, I contacted many home builders and developers for affordable and yet beautiful apartments. But, the satisfactory solution didn’t come out as they showed me expensive apartments and sometimes, locations was not as per my requirement. Later on, my friend enlightened me about BrokersBunch. I checked BrokersBunch feedbacks on real estate website and felt satisfied with customer reviews. After the profound scrutiny, I brought my dream home from BrokersBunch.</q></b><br><br>
   <p class="author">- Ernest Edison (Broker)</p>
  </div>
</div>

<div class="mySlides ">
  <div class="numbertext"><b>3 / 3</b></div>
 <br><br>
  <div class="text"> <q><b>
 
 BrokersBunch has delivered best quality apartments and possess the capability to envision their buyer’s requirement. After having visited the sites of many builders & after checking BrokersBunch reviews, we chose it. Today I am very much happy & satisfied with my decision of taking flat in BrokersBunch due to their quality and delivery.</q></b><br><br>
    <p class="author">- Thomas Hemingway (User)</p>
  </div>
</div>


<a class="prev" onclick="plusSlides(-1)" >&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
<br><br><br>
</header>
</section>







<!-- Footer -->
    <footer style="background-color: darkgrey;">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright"></span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="https://twitter.com/BrokersBunch">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.facebook.com/profile.php?id=100045338343372">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.instagram.com/brokers_bunch/">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>     







   
   
    <!-- Bootstrap core JavaScript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="assets/js/jqBootstrapValidation.js"></script>
    <script src="assets/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="assets/js/rent.js"></script>
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/testimonials.js"></script>



    <!-- loader files-->

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/main.js"></script>
  
    
  </body>
</html>
