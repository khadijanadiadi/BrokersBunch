<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');

	if($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'broker'){
		$stmt = $connect->prepare('SELECT count(*) as register_user FROM users');
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);

		

		$stmt = $connect->prepare('SELECT count(*) as total_rent FROM room_rental_registrations');
		$stmt->execute();
		$total_rent = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $connect->prepare('SELECT count(*) as total_rent_apartment FROM room_rental_registrations_apartment');
		$stmt->execute();
		$total_rent_apartment = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/*$stmt = $connect->prepare('SELECT count(*) as total_auth_user_rent FROM room_rental_registrations WHERE user_id = :user_id');
	$stmt->execute(array(
		':user_id' => $_SESSION['id']
		));
	$total_auth_user_rent = $stmt->fetch(PDO::FETCH_ASSOC);

	$stmt = $connect->prepare('SELECT count(*) as total_auth_user_rent_ap FROM room_rental_registrations_apartment WHERE user_id = :user_id');
	$stmt->execute(array(
		':user_id' => $_SESSION['id']
		));
	$total_auth_user_rent_ap = $stmt->fetch(PDO::FETCH_ASSOC);*/
?>
<?php include '../include/header.php';?>	
	<!-- Header nav -->	
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
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
              <a href="logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<!-- end header nav -->	

<header class="bimage">
<?php include '../include/side-nav.php';?>
	<section id="wrapper" style="margin-left: 16%;margin-top: -11%;">
		<!-- <div class="container"> -->
			<!-- <div class="row"> -->
				<div class="col-md-12"><br>
					
					<?php if($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'broker'){ print"<h1>"; print $_SESSION['fullname']; print"'s "; print "Dashboard </h1>"; } ?><br><br>
					<?php if($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'broker') {print "<h3> Welcome "; print $_SESSION['fullname']; print "</h3>"; } ?>
					<?php if($_SESSION['role'] == 'user') {print "<h1> Welcome "; print $_SESSION['fullname']; print "</h1>"; } ?>
					
					 <br>

					<div class="row">						
						<?php 
							if($_SESSION['role'] == 'admin'){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/users.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Registered Users <span class="badge badge-pill badge-success">'.$count['register_user'].'</span></b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>	
						 <?php 
							if($_SESSION['role'] == 'admin'){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/list_rooms.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Registered tenaments <span class="badge badge-pill badge-success">'.(intval($total_rent['total_rent'])).'</span></b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>
						

						<?php 
							if($_SESSION['role'] == 'admin'){ 
								echo '<div class="col-md-3">';
							echo '<a href="../app/list_apartment.php"><div class="alert alert-warning" role="alert">';
							echo '<b>Registered Appartment <span class="badge badge-pill badge-success">'.(intval($total_rent_apartment['total_rent_apartment'])).'</span></b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>
						
						<?php 
							if($_SESSION['role'] == 'broker'){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/list_apartment.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Registered Appartments  <span class="badge badge-pill badge-success">'.(intval($total_rent_apartment['total_rent_apartment'])).'</span></b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>
							

						<?php 
							if($_SESSION['role'] == 'broker'){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/list_rooms.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Registered tenaments <span class="badge badge-pill badge-success">'.(intval($total_rent['total_rent'])).'</span> </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>
						

						<?php 
							if($_SESSION['role'] == 'broker' or $_SESSION['role'] == 'user'){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/profile.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Manage Profile </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>			


						<?php 
							if($_SESSION['role'] == 'broker' ){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/complaint.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Give Feedback </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>

						<?php 
							if($_SESSION['role'] == 'user' ){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/search.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Search Property </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>

						<?php 
							if($_SESSION['role'] == 'user' ){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/viewappointment.php"><div class="alert alert-warning" role="alert">';
								echo '<b>View Appointment </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>


							<?php 
							if($_SESSION['role'] == 'user' ){ 
								echo '<div class="col-md-3">';
								echo '<a href="../app/complaint.php"><div class="alert alert-warning" role="alert">';
								echo '<b>Give Feedback </b>';
								echo '</div></a>';
								echo '</div>';
							} 
						?>

						

																													

									
					</div>
				</div>
			<!-- </div> -->
		<!-- </div> -->
	</section>
</header>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>