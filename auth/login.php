<?php
	require '../config/config.php';
	
	 if(isset($_POST['login'])) {

		// Get data from FORM
		$username = $_POST['username'];
		$email = $_POST['username'];
		$password = $_POST['password'];
		
		try {
			$stmt = $connect->prepare('SELECT * FROM users WHERE username = :username or email = :email ');
			$stmt->execute(array(
				':username' => $username,
				':email' => $email
				));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			if($data == false){
				$errMsg = "User $username not found.";
			}
			else {
				if(	$password == $data['password']) {
					$_SESSION['user_id'] = $data['user_id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['fullname'] = $data['fullname'];
					$_SESSION['role'] = $data['role'];
					$_SESSION['mobile'] = $data['mobile'];
					$_SESSION['email'] = $data['email'];
					
					
					header('Location: dashboard.php');
					exit;
				}
				else
					$errMsg = 'Password not match.';
			}
		
		try {
			$stmt = $connect->prepare('SELECT * FROM broker WHERE username = :username OR email = :email');
			$stmt->execute(array(
				':username' => $username,
				':email' => $email
				));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			if($data == false){
				$errMsg = "User $username not found.";
			}
			else {
				if(	$password == $data['password']) {
					$_SESSION['broker_id'] = $data['broker_id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['fullname'] = $data['fullname'];
					$_SESSION['role'] = $data['role'];
					$_SESSION['mobile'] = $data['mobile'];
					header('Location: dashboard.php');
					exit;
				}
				else
					$errMsg = 'Password not match.';
			}
		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}



}

		


		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}





	}
 ?>

<?php include '../include/header.php';?>
	<!-- Services -->
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
              <!-- <a class="nav-link" href="login.php">Login</a> -->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Sign up</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="services">
		<div class="container">
			<div class="row">				
			  <div class="col-md-4 mx-auto">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h2 class="text-center">Login</h2>
				    <form action="" method="post">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email Address/User Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email/Username" name="username" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
					    <label for="forgotpassword"><a href = "../auth/forgot.php" style="color:blue"> Forgot Password ?</a></label>
					  </div>
					  <center>
					  <button type="submit" class="btn btn-primary" name='login' value="Login">Submit</button>
					   <button type="Reset" class="btn btn-primary" name='Reset' value="Reset">Reset</button>
					</center>
					</form>				 
				 </div>
			</div>
			</div>
		</div>
	</section>

<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>