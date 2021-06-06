<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	


		try {
			if($_SESSION['role'] == 'broker' ){
				$stmt = $connect->prepare("select * from broker where broker_id = '{$_SESSION['broker_id']}'");
				$stmt->execute();
				$data1 = $stmt->fetchAll (PDO::FETCH_ASSOC);


				$stmt = $connect->prepare("SELECT * FROM room_rental_registrations_apartment  WHERE broker_id = {$_SESSION['broker_id']}");
				$stmt->execute();
				$data2 = $stmt->fetchALL(PDO::FETCH_ASSOC);
				
				$stmt = $connect->prepare(" SELECT * FROM room_rental_registrations  WHERE broker_id = {$_SESSION['broker_id']}");
				$stmt->execute();
				$data3 = $stmt->fetchALL(PDO::FETCH_ASSOC);

				// $stmt = $connect->prepare('SELECT * FROM broker');
				// $stmt->execute();
				// $data4 = $stmt->fetchAll (PDO::FETCH_ASSOC);



				$data4=array_merge($data2,$data3);
			}
				try {
			if($_SESSION['role'] == 'user' ){
				$stmt = $connect->prepare("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
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
			<br><br><h2>Your Profile</h2><br>
				<?php 
				if($_SESSION['role'] == 'broker'){
					foreach ($data1 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-4" style="padding:1%;">					
								  <div class="card-block">';
								  	echo '<a class="btn btn-warning float-right" href="updatep.php?id='.$value['broker_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">Edit Profile</a>'; 
									 echo 	'<div class="row">
													<div class="col-4">
													<h4 >Personal Details</h4>';
													 	echo '<p><b>Full Name: </b>'.$value['fullname'].'</p>';
													 	echo '<p><b>Mobile Number: </b>'.$value['mobile'].'</p>';
													 	echo '<p><b>Username: </b>'.$value['username'].'</p>';
													 	echo '<p><b>Email: </b>'.$value['email'].'</p>';
													 	echo '<p><b>Registration Certificate no.: </b>'.$value['registration_no'].'</p>';
													 echo '</div>
												
													<div class="col-5">
													<h4 >Other Details</h4>';
														echo '<p><b> State: </b>'.$value['state'].'</p><p><b> City: </b>'.$value['city'].'</p><p><b>Address: </b>'.$value['address'].'</p>';
														echo '<p><b>Role: </b>'.$value['role'].'</p>';
														echo '<p><b>Status: </b>'.$value['status'].'</p>';
													echo '</div>

													<div class="col-3">
													<h4 >Profile Image</h4>';
													echo '<br>';
													echo ' <p> <img src="'.$value['profile_img'].'" width="200px" height="200px" style="border-radius:10px"></p>';
													
													echo '</div>
										</div>				      
								   </div>
								</div>';								
												
										
					}

					echo '<br><br><h2>Properties You Listed</h2><br>';
					foreach ($data4 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-4" style="padding:1%;">					
								  <div class="card-block">';
								  	echo '<a class="btn btn-warning float-right" href="update.php?id='.$value['broker_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">Edit Property</a>'; 
									 echo 	'<div class="row">
													
												
											<div class="col-5">
											<h4 class=>Property Details</h4>';
											
												echo '<p><b>Owner Name: </b>'.$value['owner fullname'].'</p>';
												echo '<p><b>Plot Number: </b>'.$value['plot_number'].'</p>';

												if(isset($value['sale'])){
													echo '<p><b>Sale: </b>'.$value['sale'].'</p>';
												}										
												
													if(isset($value['apartment_name']))
														echo '<div class="alert alert-success" role="alert"><p><b>Apartment Name: </b>'.$value['apartment_name'].'</p></div>';

													if(isset($value['ap_number_of_plats']))
														echo '<div class="alert alert-success" role="alert"><p><b>Flat Number: </b>'.$value['ap_number_of_plats'].'</p></div>';
												if(isset($value['own'])){
													echo '<p><b>Available Area: </b>'.$value['area'].'</p>';
													echo '<p><b>Floor: </b>'.$value['floor'].'</p>';
													
													echo '<p><b>Owner: </b>'.$value['own'].'</p>';
													echo '<p><b>Purpose: </b>'.$value['purpose'].'</p>';
												}
												echo '<p><b>Number of  Rooms: </b>'.$value['room no'].'</p>';
													echo '<p><b>Address: </b>'.$value['address'].'</p>';
														if ($value['image'] !== 'uploads/') {
											 		# code...

											 		echo '<p> <b> Property image: </b> </p> <p> <img src="'.$value['image'].'" width="250px" height="200px" style="border-radius:10px"></p>';
											 	}
											 
											
										echo '</div>


										<div class="col-3">
											<h4>Other Details</h4>';
											echo '<p><b> State: </b>'.$value['state'].'</p><p><b> City: </b>'.$value['city'].'</p><p><b>Address: </b>'.$value['address'].'</p>';
											echo '<p><b>Amenities: </b>'.$value['accommodation'].'</p>';
											echo '<p><b>Description: </b>'.$value['description'].'</p>';
												if($value['vacant'] == 0){ 
													echo '<div class="alert alert-danger" role="alert"><p><b>Sold</b></p></div>';
												}else{
													echo '<div class="alert alert-success" role="alert"><p><b>Unsold</b></p></div>';
												} 

											echo '<p><b>Landmark: </b>'.$value['landmark'].'</p>';
											echo '<p><b>Deposit: </b>'.$value['deposit'].'</p>';
											echo '</div>
											

										</div>				      
								   </div>
								</div>';								
												
										
					}



				}


				elseif($_SESSION['role'] == 'user' ){


						foreach ($data1 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-4" style="padding:1%;">					
								  <div class="card-block">';
								  	echo '<a class="btn btn-warning float-right" href="updatep.php?id='.$value['user_id'].'&act=';if(!empty($value['own'])){ echo "ap"; }else{ echo "indi"; } echo '">Edit Profile</a>'; 
									 echo 	'<div class="row">
											<div class="col-4">
											<h4 >Personal Details</h4>';
											 	echo '<p><b>Full Name: </b>'.$value['fullname'].'</p>';
											 	echo '<p><b>Mobile Number: </b>'.$value['mobile'].'</p>';
											 	echo '<p><b>Username: </b>'.$value['username'].'</p>';
											 	echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 	
											 	
										echo '</div>
											<div class="col-5">
													<h4 >Other Details</h4>';
														echo '<p><b> State: </b>'."Rajasthan".'</p><p><b> City: </b>'."Udaipur".'</p><p><b>Area: </b>'."Govardhan villa".'</p>';
														echo '<p><b>Role: </b>'.$value['role'].'</p>';
														echo '<p><b>Status: </b>'.$value['status'].'</p>';
													echo '</div>


											<div class="col-3">
													<h4 >Profile Image</h4>';
													echo '<br>';
													echo ' <p> <img src="'.$value['profile_img'].'" width="200px" height="200px" style="border-radius:10px"></p>';
													
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