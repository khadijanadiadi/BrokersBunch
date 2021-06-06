<?php
	require '../config/config.php';

	
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
	<script>

       
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
			  		<h2 class="text-center">Make Payment</h2><br>	
				  	<form action="" method="post">
				  		<div class="row">
				  			<div class="col-6">
						  	  	<div class="form-group">
				  					<input type="radio" name="cardtype" value="Debit card" required> Debit Card
				  				</div>
				  			</div> 
				  			<div class="col-6">
						  	  	<div class="form-group">
				  					<input type="radio" name="cardtype" value="Credit card" required> Credit Card
				  				</div>
				  			</div> 
				  			
				  		</div>

				  		<div class="row">
					  	    <div class="col-6">
						  	  	<div class="form-group">
						  	  	 <label for="cardnumber">Card Number</label>
            					    <input type="text" class="form-control" id="card number" pattern="^(\d{16})$" placeholder=" xxxx-xxxx-xxxx-xxxx" name="Card Number" required >
						  	  </div>
						 	</div>
							<div class="col-6">					  
							  <div class="form-group">
							  	 <label for="Expiry month">Expiry Month</label>
					       <select name= "month" class="form-control"> 
                  <option value= "month"> 1 </option>
                  <option value= "month"> 2 </option>
                  <option value= "month"> 3 </option>
                  <option value= "month"> 4 </option>
                  <option value= "month"> 5 </option>
                  <option value= "month"> 6 </option>
                  <option value= "month"> 7 </option>
                  <option value= "month"> 8 </option>
                  <option value= "month"> 9 </option>
                  <option value= "month"> 10 </option>
                  <option value= "month"> 11 </option>
                  <option value= "month"> 12 </option>
                </select>
                  
							  </div>
							 </div>
						</div>
  					 <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							  	 <label for="expiry year">Expiry Year</label>
                 <select name= "year" class="form-control">
                   
                   
                 
                  <option value="year"> 2020 </option>
                  <option value="year"> 2021 </option>
                  <option value="year"> 2022 </option>
                  <option value="year"> 2023 </option>
                  <option value="year"> 2024 </option>
                  <option value="year"> 2025 </option>
                  <option value="year"> 2026 </option>
                  <option value="year"> 2027 </option>
                  <option value="year"> 2028 </option>
                  <option value="year"> 2029 </option>
                  <option value="year"> 2030 </option>
                
                 
                 </select>

						  	  	 </div>
							 </div>
							 	<div class="col-6">
							  <div class="form-group">
							  	<label for="cvv">Cvv</label>
                 <input type="password" class="form-control" id="cvv"pattern="^(\d{3})$" placeholder="xxx" name="cvv" required>
						  	  	</div>
							 </div>
						</div>
						  	
					   	
					  
					  
					  	
					  <center>
					  <button type="submit" class="btn btn-primary" name='register' value="register">Make Payment</button>
					   <button type="Reset" class="btn btn-primary" name='Reset' value="Reset">Reset</button>
					  </center>
					   <a href="../app/appointment.php" ><font color="blue"> back to merchant site</font> </a>
					</form>	
				</div>
			</div>
		</div>
	</div>

</body>
</html>
<?php include '../include/footer.php';?>
<?php include '../include/chat.php';?>




