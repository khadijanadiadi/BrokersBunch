<?php
  require '../config/config.php';
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BrokersBunch</title>
    <link rel = "icon" type = "image/png" href = "../titlelogo.png" height="10px">

    <!-- Bootstrap core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../assets/css/rent.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/chat.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <!-- Navigation -->

    <button class="open-button" onclick="openForm()"><img  class="icon" src="../msg.png" height="55 " width="55" align="middle" /></button>

<div class="chat-popup stylefont" id="myForm" >
  <form action="/action_page.php" class="form-container">
    <label for="msg"> <font color="white"><b>Send a Message</b></font></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"  id="mainNav">
      <div class="container">
<a class="navbar-brand js-scroll-trigger" href="../index.php"> 
<img src="../finallogo.png" height="5%" width="40%" border=solid>
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
                  echo '<a class="nav-link" href="../auth/login.php">Login</a>';
                echo '</li>';


                     echo '<li class="nav-item">';
                       echo '<a class="nav-link" href="./auth/register.php">Sign up</a>';
                     echo '</li>';
              }else{
                   echo '<li class="nav-item">';
                echo '<a class="nav-link" href="#">';
                echo $_SESSION['fullname'];  
                if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } 
                elseif($_SESSION['role'] == 'broker'){ echo "(Broker)";}
                echo '</li>';


                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="../auth/logout.php">Logout</a>';
                echo '</li>';


              }
            ?>

         

            
          </ul>
        </div>
          </ul>
        </div>
      </div>
    </nav>

<header class="about">
      <div class="container">
        <div class="intro-text">
          <div class="intro-heading text-uppercase">About Us  </div>
          
        </div>

        
      </div>
      <div class="intro-lead-in"><div class="line">Don't go beyond and above just get your Dream Home now...! </div></div>
<br> <br><br><br>
    </header>
  
     <!-- Search -->
    <section id="asearch">
      <div class="container">
            

            <div class="row">

               
              <h4> About Us <hr class="hr"></h4><br>
              <h5>

BrokersBunch is established to address the issue in the Real Estate industry of absence of approved property. We convert dreams to substances. We are consistently looking for discovering individuals with whom we can develop our item. The entirety of our group is sought to turn out to be more than we have ever been: progressively inquisitive, more prominent in soul, more grounded in inventive certainty, bigger in reason. We felt that we owed something to ourselves and our latent capacity, not simply to our own selves or even our very own association, yet to our customers and individual creatures also. Consistently, our clients come to us looking for answers for bunch issues and with tremendous desires. They issue explicit agreements. We set a strategic ourselves – to take the entirety of that and afterward include one overall command, that through this and each future commitment, we will endeavor to carry thoughts that empower customers to be more than what they as of now are. By this we tried to make arrangements that will amaze our customers, which might be conveyed in front of anticipated time; and acquire that 'stunning' factor.
</h5>
               
            </div>
            </div>
            <br>


            <div class="container">
            <div class="row">

               
              <h4> Our Vision <hr class="hr"></h4><br>
              <h5>




We are glad for what our identity is, our main thing, how we approach our work and the clients with whom we work. Day by day we endeavor to never dismiss what is required to be an accomplice of decision by applying our abilities and industry information to give answers for the difficulties our clients face. 

We accept that a solitary thought can change the world. Be that as it may, good thoughts possibly matter when they become genuine, prepared to-dispatch items and administrations. That is the reason our central goal is to enable our clients to take out the boundaries among thoughts and business results.

</h5>
               
            </div>
          </div>
<br>



          <div class="container">
            <div class="row">

               
              <h4> 	Get in touch <hr class="hr"></h4>
  		 </div>

              	<form action="" method="post" style="align-items: center;">
				  		
							
  					 		
						  	<div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="fullname"><h3>Full Name</h3></label>
							    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required>
							  </div>  
							</div>
							
					   	</div>
					   	
					   		<div class="row">
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="email"><h3>Email</h3></label>
							    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
							  </div>
							 </div>
						</div>

						<div class="row">
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="registration"><h3>Message</h3></label>
							  <textarea class="form-control" name="comment" name = "message" id ="mesage" placeholder="Enter your message here" ></textarea> 
							  </div>
							 </div>
						</div>
					  
					  <button type="submit" class="btn btn-primary" name='register' value="register">Send</button>
					   <button type="Reset" class="btn btn-primary" name='Reset' value="Reset">Reset</button>
					 
					</form>
               
         
          </div>
   
      
     
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
                <span>Email:  brokersbunchsem6@gmail.com</span>
              </li>
             </ul>

             <ul class="list-inline social-buttons">
              <li class="list-inline-item">
               <span> Address:  Navrangpura, Ahmedabad</span>
              </li>
          </ul>

          <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <span> Contact No.:  8849586519</span>
              </li>
          </ul>
            
          </div>

          
        </div>
        <br>
       <!-- <div class="row">
        <div class="col-md-12">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <span><img src="../assets/img/map.jpeg" height="300px" width="500px"></span>
              </li>
             </ul>
           </div>
         </div> -->
<br>
      	
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
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../assets/plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="../assets/js/jqBootstrapValidation.js"></script>
    <script src="../assets/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../assets/js/rent.js"></script>
    <script src="../assets/js/chat.js"></script>
  </body>
</html>
