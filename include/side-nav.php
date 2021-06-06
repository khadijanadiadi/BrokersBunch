<?php
	if(empty($_SESSION['role']))
		header('Location: login.php');

?>
<!-- <section> --><br>
	<nav class="navbar navbar-expand-sm navbar-default sidebar" style="background-color:#212529;" id="mainNav">
      <div class="container">
      	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive1">
          <ul class="navbar-nav text-center" style="    flex-direction: column;">      
            <li class="nav-item">
               <?php if($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'broker' or $_SESSION['role'] == 'user'){ 
                  echo'<a href="../auth/dashboard.php" class="nav-link">Home</a>';
                  }
                
                ?>
           </li>

            <li class="nav-item">
               <?php if($_SESSION['role'] == 'admin'){ 
	        	      echo'<a href="../app/list_admin.php" class="nav-link">Details</a>';
                  }
                  elseif ($_SESSION['role'] == 'broker'){
                  echo '<a href="../app/list.php" class="nav-link">View Properties</a>';
                  }
                ?>
                <li class="nav-item">
               <?php if($_SESSION['role'] == 'user'){ 
                  echo'<a href="../app/search.php" class="nav-link">Search</a>';
                  }
                ?>
           </li>
<li class="nav-item">
               <?php if($_SESSION['role'] == 'user' or $_SESSION['role'] == 'broker'){ 
                  echo'<a href="../app/viewappointment.php" class="nav-link">View Appointment </a>';
                  }
                ?>
           </li>





            


              <li class="nav-item">
              <?php if($_SESSION['role'] == 'broker'){ 
                echo '<a href="../app/register.php" class="nav-link">Add Property</a>';
              } ?>
            </li>
          

         
            <li class="nav-item">
              <?php if($_SESSION['role'] == 'admin'){ 
                echo '<a href="../app/cmplist.php" class="nav-link">Feedbacks</a>';


              } 
              elseif ($_SESSION['role'] == 'broker' or $_SESSION['role'] == 'user'){
                      echo '<a href="../app/complaint.php" class="nav-link">Feedback</a>';
                    }
              ?>
            </li>


            <li class="nav-item">
              <?php if($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'broker'){ 
                echo '<a href="../reports" class="nav-link">Generate Reports</a>';


              } 
             
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- </section> -->