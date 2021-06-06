<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	


		try {
			if($_SESSION['role'] == 'broker' ){
				$stmt = $connect->prepare("SELECT * FROM appt  WHERE broker_id = '{$_SESSION['broker_id']}'");
				$stmt->execute();
				$data1 = $stmt->fetchAll (PDO::FETCH_ASSOC);



			}
				try {
			if($_SESSION['role'] == 'user' ){
				$stmt = $connect->prepare("SELECT * FROM appt WHERE user_id = '{$_SESSION['user_id']}'");
				$stmt->execute();
				$data1 = $stmt->fetchAll (PDO::FETCH_ASSOC);
			}
		}catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}	
			
		}catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}	
		// print_r($data1);	
		// echo "<br><br><br>";
		// print_r($data2);
		// echo "<br><br><br>";	
		// print_r($data);	
?>
<?php include '../include/header.php';?>

	<!-- Header nav -->	
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#212529;" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../finallogo.png" height="5%" width="40%" border=solid></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
           <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } elseif($_SESSION['role'] == 'broker'){ echo "(Broker)";} ?></a>
            </li>
            <li class="nav-item">
              <a href="../auth/logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="bimage">
	<!-- end header nav -->
	<section style="padding-left:0px;">
		<?php include '../include/side-nav.php';?>
	</section>

<section class="wrapper" style="margin-left: 16%;margin-top: -23%;">
	<div class="container">
		<div class="row">
			<div class="col-12">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			</br></br><h2>Appointment Details</h2><br>
				<?php 
				if($_SESSION['role'] == 'broker'){
					foreach ($data1 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-4" style="padding:1%;">					
								  <div class="card-block">';
								  	echo '<a class="btn btn-warning float-right" href="appointment.php?id='.$value['broker_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">Reschedule	</a> <br><br>';
								  	echo '<a class="btn btn-warning float-right" href="appointment.php?id='.$value['broker_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '"> &nbsp&nbsp&nbsp Cancel	&nbsp&nbsp&nbsp&nbsp</a>';
									 echo 	'<div class="row">
											<div class="col-4">
											<h4 >Appointment Details</h4>';
											 	
											 	// echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	// echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	echo '<p><b>Appointment Date: </b>'.$value['adate'].'</p>';
										 		echo '<p><b>Appointment Time: </b>'.$value['atime'].'</p>';
										 	
										 	
											 	
											 	
										echo '</div>

												<div class="col-4">
											<h4 >Client Details</h4>';
											 	
											 	// echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	// echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 
										 		echo '<p><b>Client Mobile: </b>'.$value['mobile'].'</p>';
										 		echo '<p><b>Client Email: </b>'.$value['email'].'</p>';
										 		echo '<p><b>Client Name: </b>'.$value['username'].'</p>';
										 		
										 			
										 	
											 	
											 	
										echo '</div>
									

											<div class="col-4">
											<h4 >Property Details</h4>';
											 	
											 	// echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	// echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	echo '<p><b>Owner name: </b>'."Mohit Chauhan".'</p>';
										 		echo '<p><b>State: </b>'."Gujarat".'</p>';
										 		echo '<p><b>City: </b>'."Ahmedabad".'</p>';
										 		echo '<p><b>Area: </b>'."Maninagar".'</p>';
										 		echo '<p><b>Price: </b>'."100000".'</p>';
										 		echo '<p><b>Plot number: </b>'."633".'</p>';
										 		echo '<p><b>Rooms: </b>'."2BHK".'</p>';
										 		echo '<p><b>Address: </b>'."Opposite Bawarchee Restaurant".'</p>';
										 		echo '<p><b>Landmark: </b>'."Hotel Dev Corporate".'</p>';
										 		echo '<p><b>Accomodation: </b>'."Full Furnished".'</p>';
										 		echo '<p><b>Property Image: </b> <img src="../app/uploads/tenament/ten4.jpg" height="100px" widhth="100px"></p>';	
										 		
										 		
										 			
										 	
											 	
											 	
										echo '</div>
									
											
										</div>				      
								   </div>
								</div>';								
												
										
					}
				}


				elseif($_SESSION['role'] == 'user' ){

						$stmt = $connect->prepare("SELECT * FROM room_rental_registrations WHERE broker_id IN (SELECT broker_id FROM appt WHERE user_id = '{$_SESSION['user_id']}')");
						$stmt->execute();
						$data9 = $stmt->fetchAll (PDO::FETCH_ASSOC);

						foreach ($data1 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-4" style="padding:1%;">					
								  <div class="card-block">';
								  	echo '<a class="btn btn-warning float-right" href="appointment.php?id='.$value['user_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">Reschedule	</a> <br><br>';

								  	echo '<a class="btn btn-warning float-right" href="appointment.php?id='.$value['user_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">&nbsp&nbsp&nbsp Cancel	&nbsp&nbsp&nbsp&nbsp</a>';
								  	
								  	



									 echo 	'<div class="row">
											<div class="col-4">
											<h4 >Appointment Details</h4>';
											
											 	
											 	//echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	//echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	echo '<p><b>Appointment Date: </b>'.$value['adate'].'</p>';
										 		echo '<p><b>Appointment Time: </b>'.$value['atime'].'</p>';
										 		echo '<p><b>Mobile: </b>'.$value['mobile'].'</p>';
										 		echo '<p><b>Email: </b>'.$value['email'].'</p>';
										 	
											 	
											 	
										echo '</div>
											

											<div class="col-4">
											<h4 >Broker Details</h4>';
											
											 	
											 	//echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	//echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	echo '<p><b>Broker Name: </b>'."Saumya vyas".'</p>';
										 		echo '<p><b>Mobile: </b>'."8945712456".'</p>';
										 		echo '<p><b>Email: </b>'."saumya@gmail.com".'</p>';
										 	
											 	
											 	
										echo '</div>
											

											<div class="col-4">
											<h4 >Property Details</h4>';
											 	
											 	// echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	// echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	echo '<p><b>Owner name: </b>'."Mohit Chauhan".'</p>';
										 		echo '<p><b>State: </b>'."Gujarat".'</p>';
										 		echo '<p><b>City: </b>'."Ahmedabad".'</p>';
										 		echo '<p><b>Area: </b>'."Maninagar".'</p>';
										 		echo '<p><b>Price: </b>'."100000".'</p>';
										 		echo '<p><b>Plot number: </b>'."633".'</p>';
										 		echo '<p><b>Rooms: </b>'."2BHK".'</p>';
										 		echo '<p><b>Address: </b>'."Opposite Bawarchee Restaurant".'</p>';
										 		echo '<p><b>Landmark: </b>'."Hotel Dev Corporate".'</p>';
										 		echo '<p><b>Accomodation: </b>'."Full Furnished".'</p>';
										 		echo '<p><b>Property Image: </b> <img src="../app/uploads/tenament/ten4.jpg" height="100px" widhth="100px"></p>';	
										 		
										 		
										 			
										 	
											 	
											 	
										echo '</div>

										</div>				      
								   </div>
								</div>';							
												
										
					}

				}
				?>				
			</div>
		</div>
	</div>	
</section>
</header>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>