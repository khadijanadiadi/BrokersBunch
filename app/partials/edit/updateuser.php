
<!-- <div class="row"> -->			
  <div class="col-md-11 col-xs-12 col-sm-12"><br>  	
  	<div class="alert alert-info" role="alert">
  		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
  		<h2 class="text-center">Update Profile</h2>
  		<form action="" method="POST">
		  	 <div class="row">
		  	 	<div class="col-md-4">
			  	  <div class="form-group">
				    <label for="fullname">Full Name</label>
				     <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['user_id']; ?>">
				    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="<?php echo $data['fullname']?$data['fullname']:''; ?>" required>
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input type="text" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" value="<?php echo $data['broker mobile']?$data['broker mobile']:''; ?>" required>
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="alternat_mobile">Username</label>
				    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $data['username']?$data['username']:''; ?>" required>
				  </div>
				</div>
			</div>

			<div class="row">
		  	 	<div class="col-md-4">
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $data['email']?$data['email']:''; ?>" required>
				  </div>
				 </div>



				 <div class="col-md-4">
			  <div class="form-group">
			    <label for="country">Country</label>
			    <input type="country" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo $data['country']?$data['country']:''; ?>" required>
			  </div>
			  </div>
				
			 <div class="col-md-4">
			  <div class="form-group">
			    <label for="state">State</label>
			    <input type="state" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $data['state']?$data['state']:''; ?>" required>
			  </div>
			  </div>
				 
			</div>

			<div class="row">
				

			 
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="city">City</label>
			    <input type="city" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $data['city']?$data['city']:''; ?>" required>
			  </div>
			  </div>

			   <div class="col-md-4">
			  <div class="form-group">
			    <label for="city">Profile Image</label>
			    <input type="file" class="form-control" id="profile"  name="profile" value="<?php echo $data['profile']?$data['profile']:''; ?>" required>
			  </div>
			  </div>

			 </div>
			 
			 


			
			 
			  
			    			
			  <button type="submit" class="btn btn-primary" name='register_apartment' value="register_apartment">Submit</button>
			</form>	
			</div>			
  	</div>
<!-- </div> -->	