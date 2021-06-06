<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');

		if ( isset($_GET['id'])) {
			$id = $_REQUEST['id'];
		}	

		if ( isset($_GET['act'])) {
			$active = $_REQUEST['act'];

			if ($active === 'ap') {
				# code...
				try {
					$stmt = $connect->prepare('SELECT * FROM broker where id = :id');
					$stmt->execute(array(
						':id' => $id
					));
					$data = $stmt->fetch(PDO::FETCH_ASSOC);				
				}catch(PDOException $e) {
					$errMsg = $e->getMessage();
				}
			}
		}
		
		


	if(isset($_POST['profile'])) {
			$errMsg = '';
			// Get data from FROM
			$fullname = $_POST['fullname'];
			$username=$_post['username'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			
			$country = $_POST['country'];
			$state = $_POST['state'];
			$city = $_POST['city'];
			
			$id = $_POST['id'];
			

			try {
				$stmt = $connect->prepare('UPDATE broker SET fullname = ?, username = ?, email = ?, mobile = ?, country = ?, state = ?, city = ?  WHERE id = ?');
				
				// foreach ($_POST['ap_number_of_plats'] as $key => $value) {
					# code...
					$stmt->execute(array(
						$fullname,
						$username,
						$email,
						$mobile,
						
						$country,
						$state,
						$city,
						$id,
						
					));				
				// }
				header('Location: updatep.php?action=reg');
				exit;
			}catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'reg') {
		$errMsg = 'Update successfull. Thank you';
	}
			
		//print_r($data);	
		// echo "<br><br><br>";
		// print_r($data2);
		// echo "<br><br><br>";	
		// print_r($data);	
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
              <a href="../auth/logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

	<!-- end header nav -->


<header class="bimage">
<?php include '../include/side-nav.php';?>
<section class="wrapper" style="margin-left: 16%;margin-top: -11%;">
	<?php
		if (isset($active)) {
			# code...
				include 'partials/edit/updatebroker.php';
			
		}  		
		else
			include 'partials/edit/updateuser.php';
			
  	?>

</section>
</header>
<?php include '../include/footer.php';?>

