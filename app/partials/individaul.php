<!-- <div class="row"> -->			
  <div class="col-md-11 col-xs-12 col-sm-12">
  	<div class="alert alert-info" role="alert">
  		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
  		<h2 class="text-center">Tenament Registeration</h2>
  		<form action="" method="post" enctype="multipart/form-data">
		  	 <div class="row">
		  	 	<div class="col-md-4">
			  	  <div class="form-group">
				    <label for="fullname">Full Name</label>
				    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required>
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input type="text" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" required>
				  </div>
				 </div>

				<div class="col-md-4">
				  <div class="form-group">
				    <label for="alternat_mobile">Alternate Mobile</label>
				    <input type="text" class="form-control" pattern="^(\d{10})$" id="alternat_mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="alternat_mobile">
				  </div>
				</div>
			</div>

			<div class="row">
		  	 	<div class="col-md-4">
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="plot_number" >Home Number</label>
				    <input type="text" class="form-control" id="plot_number" placeholder="Plot Number/Home Number" name="plot_number" required>
				  </div>
				 </div>

				 <div class="col-md-4">
				  <div class="form-group">
				    <label for="rooms">No. of Rooms</label>
				    <input type="text" class="form-control" id="rooms" placeholder="1BHK/2BHK/3BHK/1RK" name="rooms" required>
				  </div>
				 </div>
			</div>

			<div class="row">
				 <div class="col-md-4">
			  <div class="form-group">
			    <label for="state">State</label>
			    <input type="state" class="form-control" id="state" placeholder="State" name="state" required>
			  </div>
			  </div>
				

							 
							 	 <div class="col-md-4">
			  <div class="form-group">
			    <label for="city">City</label>
			    <input type="city" class="form-control" id="city" placeholder="City" name="city" required>
			  </div>
			  </div>
							

							
							 <div class="col-md-4">
							  <div class="form-group">
							  	 <label for="area">Area</label>
							  	<input type="area" class="form-control" id="area" placeholder="Area" name="area" required>
							   
							 		   
															    
									
								
						  	  	</div>
							 </div>
							
			 </div>

			 <div class="row">
			  <div class="col-md-4">
			 <div class="form-group">
			    <label for="price">Price</label>
			    <input type="price" class="form-control" id="price" placeholder="Price" name="price" required>
			  </div>
			  </div>

			 
			  <div class="col-md-4">

			  <div class="form-group">
			    <label for="accommodation">Facilities</label>
			    <input type="accommodation" class="form-control" id="accommodation" placeholder="Facilities" name="accommodation" required>
			  </div>
			  </div>

			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="address">Address</label>
			    <input type="address" class="form-control" id="address" placeholder="Address" name="address" required>
			  </div>
			   </div>

			  </div>
						
			   <div class="row">
			 	<div class="col-md-4">
			  <div class="form-group">
			    <label for="description">Description</label>
			    <input type="description" class="form-control" id="description" placeholder="Description" name="description" required>
			  </div>
			   </div>
			  <div class="col-md-4">
			  <div class="form-group">
			    <label for="landmark">Landmark</label>
			    <input type="landmark" class="form-control" id="landmark" placeholder="landmark" name="landmark">
			  </div>
			   </div>

			   <div class="col-4">
			 		 <div class="form-group">
					    <label for="vacant">Sold/Unsold</label>
					    <select class="form-control" id="vacant" name="vacant">
					    	<option value="0">Unsold</option>
					      <option value="1">Sold</option>
					      
					    </select>
					  </div>
			 	</div>
			  
			    </div>				  
			  
			   <div class="row">
			   	
				<div class="col-md-4">
			  <div class="form-group">
			    <label for="description">Image</label>
			    <input type="file" name="image" id="image" required>
			  </div>
			  </div>
			  </div>			
			  <button type="submit" class="btn btn-primary" name='register_individuals' value="register_individuals">Submit</button>
			</form>	
			</div>			
  	</div>

<!-- </div> -->