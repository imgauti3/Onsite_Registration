<?php include_once('header.php'); ?>
<?php
if (isset($_POST['btnSubmit']) && !empty($_POST['emailid'])) {
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $emailid = mysqli_real_escape_string($connect, $_POST['emailid']);
    $mobileno = mysqli_real_escape_string($connect, $_POST['mobileno']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $place = mysqli_real_escape_string($connect, $_POST['place']);
    $reference_note = mysqli_real_escape_string($connect, $_POST['reference_note']);
    $kit = mysqli_real_escape_string($connect, $_POST['kit']);
    $certificate_printed = mysqli_real_escape_string($connect, $_POST['certificate_printed']);
    $day1_lunch = mysqli_real_escape_string($connect, $_POST['day1_lunch']);
    $certificate = mysqli_real_escape_string($connect, $_POST['day1_dinner']);
    $certificate = mysqli_real_escape_string($connect, $_POST['day2_lunch']);
    
    $unique_id = $db->generateRandomString(6);
    
    $iqry = mysqli_query($connect, "insert into delegate_list set fullname='$fname', certificate_name='$fname', emailid='$emailid', mobileno='$mobileno', reg_category='$category', place='$place', reference_note='$reference_note', kit='$kit', unique_id='$unique_id', certificate_printed='$certificate_printed', day1_lunch='$day1_lunch', day1_dinner='$day1_dinner', day2_lunch='$day2_lunch'");
    if ($iqry) {
        $_SESSION['successMsg'] = 'New user has been created successfully.';
    } else {
        $_SESSION['errorMsg'] = 'Something went wrong. Please try again later.';
    }
    echo "<script>location.href='index.php';</script>";
    exit();
}
?>
			
			<!-- -->
			<div class="appmt-form doctors-col registratio-section">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
						<h2>Add New</h2>
					</div>
				</div>
					<div class="row justify-content-center">
						<div class="col-12 col-lg-12">
						    
						    <?php
						    if (isset($_SESSION['successMsg'])) { ?>
						        
						        <div class="alert alert-success" role="alert">
                                  <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']);?> 
                                </div>
						    <?php } else if (isset($_SESSION['errorMsg'])) { ?>
						        <div class="alert alert-success" role="alert">
                                  <?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg']);?> 
                                </div>
						   <?php }  ?>
						   
						   <form method="post" id="addnewForm" name="addnewForm">
							<div class="row">
							    
								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" required="">
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" id="emailid" name="emailid" placeholder="Enter Email ID" required="" >
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Mobile Number</label>
										<input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Enter Mobile No.">
									</div>
								</div>

								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Registration Category</label>
										<select class="form-control" id="category" name="category" required="">
											<option value="" disabled="" selected="">--Select--</option>
											<option value="Faculty">Faculty</option>
											<option value="Post Graduate">Post Graduate</option>
											<option value="Delegate">Delegate</option>
											<option value="Accompanying Person">Accompanying Person</option>
											<option value="Only Entry Exhibitor">Only Entry Exhibitor*</option>
											<option value="Exhibitor">Exhibitor</option>
											<option value="Support Staff">Support Staff</option>
											<option value="Event Crew">Event Crew</option>
											<option value="Conference Manager">Conference Manager</option>
											<option value="Media">Media</option>
											<option value="Organizing  Committee">Organizing  Committee</option>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Place</label>
										<input type="text" class="form-control" id="place" name="place" placeholder="Please Enter your place">
									</div>
								</div>										
								<div class="col-12 col-md-6 col-lg-4">
									<div class="form-group">
										<label>Reference / Note</label>
										<input type="text" class="form-control" id="reference_note" name="reference_note" placeholder="Please Enter your reference / note">
									</div>
								</div>			
								<div class="col-12 col-md-12 col-lg-12">							
									<div class="doctors-title text-center">
										<h2>Not Allow Category</h2>
									</div>		
								</div>
								<?php
								$sqry = mysqli_query($connect, "select * from allow_not_allowed where 1=1");
								if (mysqli_num_rows($sqry) > 0) {
								    while($res = mysqli_fetch_assoc($sqry)) {
								        ?>
								        <div class="col-12 col-md-6 col-lg-6">
									<div class="form-group">
										<input type="checkbox" class="largerCheckbox" name="<?php echo $res['type_name'];?>" id="<?php echo $res['type_name'];?>" value="0">
										<label for="tall-1" style="position: relative;bottom: 5px;"><?php echo $res['type'];?></label>
									</div>
								</div>
								        <?php
								    }
								    
								}
								?>
																
								
								<div class="col-12 col-md-12 text-center">
									<input type="submit" class="btn-yellow" value="Submit" id="btnSubmit" name="btnSubmit">
								</div>
								
							</div>
							</form>
						</div>
					</div>
				</div>				
			</div>
			<!-- / -->


			<!-- Section -->
			<section class="doctors-col registratio-section" style="display:none;">
				<div class="container">	
				   <div class="row">
						<div class="col-lg-4"></div>	
						<div class="col-lg-4">
							<div class="profile-widget">
								<div>
										<img class="img-fluid" alt="User Image" src="badgetop.jpg">
								</div>
								<div class="pro-content" style="text-align: center;">
									<img src="qrcode.jpg" alt="qr code" style="width: 50%;margin: 0 auto;">
									<h3 class="title">Denby Cathey</h3>
									<p class="speciality">MBBS, MD - Ophthalmology</p>
									<img src="barcode.gif" style="width: 75%;margin: 0 auto;">
								</div>									
								<div class="pro-footer">
									<a href="#"><ul class="policy-menu text-center">
										<li> <a href="#">Print</a></li>
									</ul></a>
								</div>
							</div>
						</div>
				   </div>
				</div>
			</section>
			<!-- /Section -->
			<?php include_once('footer.php'); ?>