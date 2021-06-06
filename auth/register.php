<?php
	require '../config/config.php';


	if(isset($_POST['register'])) {
		$errMsg = '';

		
		$usertype = $_POST['usertype'];
		if ($usertype=="broker")
		{

				$state = $_POST['state'];
				$city = $_POST['city'];
				$address = $_POST['address'];
				$gender = $_POST['gender'];
				$fullname = $_POST['fullname'];
				$username = $_POST['username'];
				$mobile = $_POST['mobile'];
				$email = $_POST['email'];
				$pancard = $_POST['pancard'];
				$password = $_POST['password'];
				$registration_no = $_POST['registration_no'];

			try {
				
				
				
						
				$stmt = $connect->prepare('INSERT INTO broker (state, city, address, fullname, gender,  mobile, username, email, pan_card_no, password,  registration_no, role) VALUES (:state, :city, :address, :fullname, :gender,  :mobile, :username, :email, :pancard, :password, :registration_no, :role)');
				$stmt->execute(array(
					':state' => $state,
					':city' => $city,
					':address' => $address,
					':fullname' => $fullname,
					':gender' => $gender,
					':mobile' => $mobile,
					':username' => $username,
					':email' => $email,
					':pancard' => $pancard,
					':password' => $password,
					':registration_no' => $registration_no,
					':role' => $usertype
					//':profile_image' => $target_file
					));
				
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	else{

		
		
				try {
					$usertype = $_POST['usertype'];
					$gender = $_POST['gender'];
					$state = $_POST['state'];
					$city = $_POST['city'];
					$address = $_POST['address'];
					$gender = $_POST['gender'];
					$fullname = $_POST['fullname'];
					$username = $_POST['username'];
					$mobile = $_POST['mobile'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					


				$stmt = $connect->prepare('INSERT INTO users (state, city, address, fullname, gender, mobile, username, email, password, role) VALUES (:state, :city, :address, :fullname, :gender, :mobile, :username, :email, :password, :role)');
				$stmt->execute(array(
					':state' => $state,
					':city' => $city,
					':address' => $address,
					':fullname' => $fullname,
					':gender' => $gender,
					':mobile' => $mobile,
					':username' => $username,
					':email' => $email,
					':password' => $password,
					
					':role' => $usertype
					
					//':profile_image' => $image
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}

	}
}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		 $errMsg ='<a href="../auth/login.php"> <font color="red"> Registration successfull. Now you can Login </font> </a>';
	}
?>

<?php include '../include/header.php';?>
	<!-- <nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="../index.php">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
	    </ul>
	  </div>
	</nav> -->
	<!-- Services -->
<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript">

    function DisableMenu()
    {
        if(document.getElementById("usertype").value == "user")
        {
            document.getElementById("certificate").disabled = true;
            document.getElementById("registration_no").disabled = true;
            document.getElementById("pancard").disabled = true;
            
               
        }
        else
        {
            document.getElementById("certificate").disabled = false;
            document.getElementById("registration_no").disabled = false;
            document.getElementById("pancard").disabled = false;
            
        }                       
    }


    function change_state() {
    	
    		var xmlhttp=new XMLHttpRequest();
    		xmlhttp.open("GET","ajax.php?state="+document.getElementById('statedd').value,false);
    			xmlhttp.send(null); 
    			
    			document.getElementById("citydd").innerHTML=xmlhttp.responseText;

    	
    }    


  
			
               
	</script>
	</head>
	<body>
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
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link" href="register.php">Register</a> -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
   
<!-- <section> --><br>
	<div class="container">
		<div class="row">				
			  <div class="col-md-8 mx-auto">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h2 class="text-center">Registeration Form</h2>
				  	<form method="post">
				  		<div class="row">
					  	    <div class="col-6">
						  	  	<div class="form-group">
						  	  	<label for="Register As">Register As</label></br>
						  	  	<select name="usertype" id="usertype" class="form-control" onChange="DisableMenu()" required>
						  	  		<option value="Select" disabled selected hidden>----Select Role----</option>
						  	  		<option value="broker" >Broker</option>
						  	  		<option value="user" >Client</option>
						  	  	</select>
						  	  </div>
						 	</div>
							<div class="col-6">					  
							  <div class="form-group">
							  	 <label for="Gender">Select Gender</label>
							    <select name="gender"  class="form-control" required>
							    <option value="" disabled selected hidden>----Select Gender----</option>
							    <option value="Male">Male</option>
 								 <option value="Female">Female</option>
 								 <option value="NULL">Others</option>
						  	  	</select>
							  </div>
							 </div>
						</div>
  					 <div class="row">
					  	    <div class="col-4">
							  <div class="form-group">
							  	<label for="state">Select State</label>
							     <select id="state" class="form-control" onChange="change_state()" name="state" required >
							    <option value="" disabled selected hidden>----Select State----</option>
							    <?php
							    $link=mysqli_connect("localhost","root","");
							    mysqli_select_db($link,"newrent");
							    $res=mysqli_query($link,"select * from state");

							    while ($row=mysqli_fetch_array($res))
							    {
							    ?>
							    <option value="<?php echo $row['state_name']; ?>"> <?php echo $row["state_name"]; ?> </option>
							    <?php 
							    }
							    ?>

								</select>
						  	  	 </div>
							 </div>

							 
							 	<div class="col-4">
							  <div class="form-group">
							  	 <label for="city">Select City</label>
							  		<input type="text" class="form-control" name="city" id="city" placeholder="Enter City Name">
						  	  	</div>
							 </div>
							

							
							
							

						</div>
						  	<div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="fullname">Full Name</label>
							    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required>
							  </div>  
							</div>
							<div class="col-6">
							  <div class="form-group">
							    <label for="username">User Name</label>
							    <input type="text" class="form-control" id="username" placeholder="User Name" name="username" required>
							  </div>
						    </div>
					   	</div>
					   	<div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="mobile">Mobile</label>
							    <input type="text" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" required>
							  </div>
							 </div>
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="email">Email</label>
							    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
							  </div>
							 </div>
						</div>

						 	<div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="pancard">PAN card no.</label>
							    <input type="text" class="form-control" pattern="^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$" id="pancard"  placeholder="PAN card number" name="pancard" required>
							  </div>
							 </div>
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="address">Address</label>
							    <input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
							  </div>
							 </div>
						</div>

					  <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
					  </div>

					  <div class="form-group">
					    <label for="c_password">Confirm Password</label>
					    <input type="password" class="form-control" id="c_password" placeholder="Confirm Password" name="c_password" required>
					  </div>
					  	 <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="certificate">Upload Registration Certificate image</label>
							    <input type="file" name="certificate" id="certificate"  required>
							  </div> 
							 </div>
							 <div class="col-6">
							  <div class="form-group">
							    <label for="profile">Upload Your Profile Image</label>
							    <input type="file" name="profile" id="profile" required>
							  </div>
							 </div>
						</div>
						<div class="row">
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="registration">Regisration No.</label>
							   <input type="text" class="form-control"  id = "registration_no" pattern="^([a-zA-Z]){2}([0-9]){10}?$" placeholder=" XX0000000000" name = "registration_no" required>
							  </div>
							 </div>
						</div>
					  <center>
					  <button type="submit" class="btn btn-primary" name='register' value="register">Submit</button>
					   <button type="Reset" class="btn btn-primary" name='Reset' value="Reset">Reset</button>
					  </center>
					</form>	
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>




