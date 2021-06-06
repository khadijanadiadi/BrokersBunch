<!-- <div class="row"> -->	
<br><br>		
  <div class="col-md-11 col-xs-12 col-sm-12">
  	<div class="alert alert-info" role="alert">
  		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>

  		<h2 class="text-center">Update Tenament </h2>
  		<form action="" method="POST">
		  	 <div class="row">
		  	 	<div class="col-md-4">
			  	  <div class="form-group">
				    <label for="fullname">Owner Full Name</label>
				    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>">
				    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="<?php echo $data['broker name']?$data['broker name']:''; ?>" required>
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="plot_number">Plot Number/Home Number</label>
				    <input type="text" class="form-control" id="plot_number" placeholder="Plot Number/Home Number" name="plot_number" value="<?php echo $data['plot_number']?$data['plot_number']:''; ?>" required>
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="rooms">Available Rooms</label>
				    <input type="text" class="form-control" id="rooms" placeholder="1BHK/2BHK/3BHK/1RK" name="rooms" value="<?php echo $data['rooms']?$data['rooms']:''; ?>" required>
				  </div>
				 </div>

				
			</div>


			<div class="row">
				
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="state">State</label>
			    <input type="state" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $data['state']?$data['state']:''; ?>" required>
			  </div>
			  </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="city">City</label>
			    <input type="city" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $data['city']?$data['city']:''; ?>" required>
			  </div>
			  </div>
			 
			 <div class="col-md-4">
			  <div class="form-group">
			    <label for="area">Area</label>
			    <input type="area" class="form-control" id="area" placeholder="Area" name="area" value="<?php echo $data['area']?$data['area']:''; ?>" required>
			  </div>
			  </div>

			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="deposit">Deposit</label>
			    <input type="deposit" class="form-control" id="deposit" placeholder="Deposit" name="deposit" value="<?php echo $data['deposit']?$data['deposit']:''; ?>" required>
			  </div>
			  </div>
			  <div class="col-md-4">

			  <div class="form-group">
			    <label for="accommodation">Facilities</label>
			    <input type="accommodation" class="form-control" id="accommodation" placeholder="Facilities" name="accommodation" value="<?php echo $data['accommodation']?$data['accommodation']:''; ?>" required>
			  </div>
			  </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="address">Address</label>
			    <input type="address" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $data['address']?$data['address']:''; ?>" required>
			  </div>
			   </div>
			  </div>

			   <div class="row">
			 	<div class="col-md-4">
			  <div class="form-group">
			    <label for="description">Description</label>
			    <input type="description" class="form-control" id="description" placeholder="Description" name="description" value="<?php echo $data['description']?$data['description']:''; ?>" required>
			  </div>
			   </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="landmark">Landmark</label>
			    <input type="landmark" class="form-control" id="landmark" placeholder="landmark" name="landmark" value="<?php echo $data['landmark']?$data['landmark']:''; ?>" required>
			  </div>
			   </div>

			   
			   	<div class="col-4">
			 		 <div class="form-group">
					    <label for="vacant">Sold/Unsold</label>
					    <select class="form-control" id="vacant" name="vacant">
					      <option value="1" <?php if($data['vacant'] == '1'){echo 'selected';}?>>Sold</option>
					      <option value="0" <?php if($data['vacant'] == '0'){echo 'selected';}?>>Unsold</option>
					    </select>
					  </div>
			 	</div>
			 
			    </div>				  
			  
			  
			 	
				<!-- <div class="col-md-4">
			  <div class="form-group">
			    <label for="description">Image</label>
			    <input type="file" class="form-control">
			  </div>
			  </div> -->
			  </div>			
			  <button type="submit" class="btn btn-primary" name='register_individuals' value="register_individuals">Submit</button>
			</form>	
			</div>			
  	</div>
<!-- </div> -->