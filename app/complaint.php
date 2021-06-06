<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');
		if(isset($_POST['register'])) {
			$name = $_POST['name'];
			$cmp = $_POST['cmp'];
			$username = $_POST['username'];
			$fullname = $_POST['fullname'];
			
			try {
					$stmt = $connect->prepare('INSERT INTO cmps (name,cmp,username,fullname) VALUES (:name, :cmp,:username,:fullname)');
					$stmt->execute(array(
						':name' => $name,
						':cmp' => $cmp,
						':username' => $username,
						':fullname' => $fullname
					));
						
						
					//header('Location: register.php?action=joined');
			}catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}

		$errMsg = '<br><br> <font color="blue"> Feedback Sent Successfully </font>';
		}

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
			?><br><br>
			<h2>Give Feedback</h2>
				<form action="" method="post">
			  		<div class="row">
				  	    <div class="col-6">
					  	  <div class="form-group">
						    <label for="name">Full Name</label>
						    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $_SESSION['fullname']; ?>">

							<br>	
							<label for="name">UserName</label>				    
						    <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>
						    
						  </div>
						</div>
						<div class="col-6">
						  <div class="form-group">
						    <label for="cmp">Feedback Message</label>
						    <textarea placeholder="Text" class="form-control" id="cmp"  name="cmp" required></textarea>
						  </div>
					    </div>
				   </div>

				  <button type="submit" class="btn btn-primary" name='register' value="register">Submit</button>
				</form>			
			</div>
		</div>
	</div>	
</section>
</header>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>