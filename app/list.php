<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	

		try {
			if($_SESSION['role'] == 'broker'){
				$stmt = $connect->prepare("SELECT * FROM room_rental_registrations_apartment ap, broker b where b.broker_id =  ap.broker_id AND b.broker_id != {$_SESSION['broker_id']}");
				$stmt->execute();
				$data1 = $stmt->fetchALL(PDO::FETCH_ASSOC);
				
				$stmt = $connect->prepare(" SELECT * FROM room_rental_registrations ro, broker b where b.broker_id = ro.broker_id AND b.broker_id != {$_SESSION['broker_id']}");
				$stmt->execute();
				$data2 = $stmt->fetchALL(PDO::FETCH_ASSOC);

				// $stmt = $connect->prepare('SELECT * FROM broker');
				// $stmt->execute();
				// $data4 = $stmt->fetchAll (PDO::FETCH_ASSOC);



				$data5=array_merge($data1,$data2);
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
			</br></br><h2>List of Properties</h2>
				<?php 
					foreach ($data5 as $key => $value) {						
						echo '<div class="card card-inverse card-info mb-3" style="padding:1%;">					
								  <div class="card-block">';
								  
									   echo 	'<div class="row">
											<div class="col-4">
											<h4 >Broker Details</h4>';
											 	echo '<p><b>Broker Name: </b>'.$value['fullname'].'</p>';
											 	echo '<p><b>Mobile Number: </b>'.$value['mobile'].'</p>';
											 	//echo '<p><b>Alternate Number: </b>'.$value['alternat_mobile'].'</p>';
											 	echo '<p><b>Email: </b>'.$value['email'].'</p>';
											 echo '<p><b> State: </b>'."Gujarat".'</p><p><b> City: </b>'."Ahmedabad".'</p><p><b>Area: </b>'."Naroda".'</p>';
											 
										
										echo '</div>
											<div class="col-5">

											

											<h4 class=>Property Details</h4>';
											
											
												echo '<p><b>Plot Number: </b>'.$value['plot_number'].'</p>';

												if(isset($value['sale'])){
													echo '<p><b>Sale: </b>'.$value['sale'].'</p>';
												}										
												
													if(isset($value['apartment_name']))
														echo '<div class="alert alert-success" role="alert"><p><b>Apartment Name: </b>'.$value['apartment_name'].'</p></div>';

													if(isset($value['ap_number_of_plats']))
														echo '<div class="alert alert-success" role="alert"><p><b>Flat Number: </b>'.$value['ap_number_of_flat'].'</p></div>';
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

											 		echo '<p> <b> Property image: </b> </p> <p> <img src="'.$value['image'].'"  width="250px" height="200px" style="border-radius:10px"></p>';
											 	}
											 
											
										echo '</div>

											<div class="col-3">
											<h4>Other Details</h4>';
											echo '<p><b> State: </b>'.$value['state'].'</p><p><b> City: </b>'.$value['city'].'</p><p><b>Area: </b>'.$value['address'].'</p>';
											echo '<p><b>Amenities: </b>'.$value['accommodation'].'</p>';
											echo '<p><b>Description: </b>'.$value['description'].'</p>';
												if($value['vacant'] == 0){ 
													echo '<div class="alert alert-danger" role="alert"><p><b>Sold</b></p></div>';
												}else{
													echo '<div class="alert alert-success" role="alert"><p><b>Unsold</b></p></div>';
												} 
											echo '</div>
											
											
										</div>				      
								   </div>
								</div>';
								
								echo '<a class="btn btn-warning float-right" href="../app/complaint.php">Feedback</a><br><br>';
					}

					
					
											 
				?>				
			</div>
		</div>
	</div>	
</section>
</header>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>