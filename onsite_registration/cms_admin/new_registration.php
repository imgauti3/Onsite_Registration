<?php include_once('top_link.php'); ?>

<?php
if (isset($_POST['emailid']) && !empty($_POST['emailid'])) {
    
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $mobileno = mysqli_real_escape_string($connect, $_POST['mobileno']);
    $email = mysqli_real_escape_string($connect, $_POST['emailid']);
    $institute = mysqli_real_escape_string($connect, $_POST['institute']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $city = mysqli_real_escape_string($connect, $_POST['city']);
    $state = mysqli_real_escape_string($connect, $_POST['state']);
    $pincode = mysqli_real_escape_string($connect, $_POST['pincode']);
    $country = mysqli_real_escape_string($connect, $_POST['country']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $amount = mysqli_real_escape_string($connect, $_POST['amount']);
    $paymode = mysqli_real_escape_string($connect, $_POST['paymode']);
    $transaction_id = mysqli_real_escape_string($connect, $_POST['transaction_id']);
    $transaction_date = mysqli_real_escape_string($connect, $_POST['transaction_date']);
    
    $sqry = mysqli_query($connect, "select id from registration where emailid = '$email'");
    if (mysqli_num_rows($sqry) > 0) {
        $_SESSION['errorMsg'] = "This email is alredy registered with us.";
        echo '<script>location.href="new_registration.php";</script>';
        exit();
    }
    
    
    if (!file_exists('../media/')) {
    		mkdir('../media/');
    	}
    	
    	if(!empty($_FILES['upload_receipt']['name'])){
    		  $file_name = md5(rand(12545,99999)).$_FILES['upload_receipt']['name'];
    		  $file_size = $_FILES['upload_receipt']['size'];
    		  $file_tmp = $_FILES['upload_receipt']['tmp_name'];
    		  $file_type= $_FILES['upload_receipt']['type'];
			  move_uploaded_file($file_tmp,"../media/".$file_name);
			  $upload_receipt = "media/".$file_name;
		}
		
		
		$uid = $db->genAppId();
		$token = $db->generateRandomString(6);
		
		$iqry = mysqli_query($connect, "insert into registration set uid='$uid', fullname='$fullname', emailid='$email', mobileno='$mobileno', institute='$institute', address='$address', city='$city', state='$state', pcode='$pincode', country='$country', category='$category', amount='$amount', payment_mode='$paymode', transaction_id='$transaction_id', transaction_date='$transaction_date', upload_receipt='$upload_receipt', token='$token', payment_status=1");
		
		
		if ($iqry) {
		    $_SESSION['successMsg'] = "New Registration is Added Successful.";
		    $html="<strong>Dear $fullname</strong>, <br>
              <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
               <br><br>
              <b>Please find your registration details as mentioned below:</b><br>
              <b>Full Name</b> - $fullname<br>
              <b>Email ID</b> - $email<br>
              <b>Mobile No</b> - $mobileno<br>
             <b>Registration ID</b> - $uid<br>
              <b>Category</b> - $category<br>
              <b>Amount</b> - $amount<br>
              <b>Payment Mode</b> - $paymode<br>
              <b>Transaction ID</b> - $transaction_id<br>
              <b>Payment Date</b> - $transaction_date<br>
              <b>Payment Status</b> - Success";
                                                
            $subject="Registartion Status @ ".$event_name;
            $db->sendMail($subject,$html, $email, $applicant_name, $mail_header,$mail_footer, $event_name);
                        
		} else {
		    $_SESSION['errorMsg'] = "something went wrong please try again....";
		}
		
		echo '<script>location.href="new_registration.php";</script>';
        exit();
}
?>

            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">New Registration</h1>                           
							</div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="#"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li class="active">
                                        <strong>New Registration</strong>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                        <section class="box ">
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">   
									
										<div class="row">
<?php  if (isset($_SESSION['successMsg'])) { ?>
					<div class="col-lg-12">
						<div class="alert alert-success alert-dismissible" style="margin-top:18px;">
							<strong>Success!</strong> <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']);?>
						</div>
					</div>	
					<?php } ?>
					<?php if (isset($_SESSION['errorMsg'])) { ?>
					<div class="col-lg-12">
						<div class="alert alert-warning alert-dismissible" style="margin-top:18px;">
							<strong>Error!</strong> <?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg']);?>
						</div>
					</div>	
					<?php } ?>
											<form method="post" enctype="multipart/form-data" id="registrationForm" name="registrationForm">

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="fullname">Full Name</label>
													<span class="desc">e.g. "anything"</span>
													<div class="controls">
														<input type="text" class="form-control" id="fullname" name="fullname" required>
													</div>
												</div>											
											</div>

											

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="emailid">Email Id</label>
													<span class="desc">e.g. "some@example.com"</span>
													<div class="controls">
														<input type="email" class="form-control" id="emailid" name="emailid" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="mobileno">Mobile No.</label>
													<span class="desc">e.g. "3423"</span>
													<div class="controls">
														<input type="number" class="form-control" id="mobileno" name="mobileno" required>
													</div>
												</div>
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="institute">Institute</label>
													<span class="desc">e.g. "anything"</span>
													<div class="controls">
														<input type="text" class="form-control" id="institute" name="institute" required>
													</div>
												</div>
											</div>

											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="address">Address</label>
													<span class="desc">e.g. "anything"</span>
													<div class="controls">
														<input type="text" class="form-control" id="address" name="address" required>
													</div>
												</div>
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="city">City</label>
													<span class="desc">e.g. "anything"</span>
													<div class="controls">
														<input type="text" class="form-control" id="city" name="city" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="state">State</label>
													<span class="desc">e.g. "anything"</span>
													<div class="controls">
														<input type="text" class="form-control" id="state" name="state" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="pincode">Pincode</label>
													<span class="desc">e.g. "342311"</span>
													<div class="controls">
														<input type="text" class="form-control" id="pincode" name="pincode" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="country">Country</label>
													<div class="controls">
													<select class="form-control" id="country" name="country" required>
														<option value="" disabled >--Select--</option>
														<option value="Afghanistan">Afghanistan</option>
														<option value="Albania">Albania</option>
														<option value="Algeria">Algeria</option>
														<option value="Andorra">Andorra</option>
														<option value="Angola">Angola</option>
														<option value="Antigua and Barbuda">Antigua and Barbuda</option>
														<option value="Argentina">Argentina</option>
														<option value="Armenia">Armenia</option>
														<option value="Australia">Australia</option>
														<option value="Austria">Austria</option>
														<option value="Azerbaijan">Azerbaijan</option>
														<option value="Bahamas">Bahamas</option>
														<option value="Bahrain">Bahrain</option>
														<option value="Bangladesh">Bangladesh</option>
														<option value="Barbados">Barbados</option>
														<option value="Belarus">Belarus</option>
														<option value="Belgium">Belgium</option>
														<option value="Belize">Belize</option>
														<option value="Benin">Benin</option>
														<option value="Bhutan">Bhutan</option>
														<option value="Bolivia">Bolivia</option>
														<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
														<option value="Botswana">Botswana</option>
														<option value="Brazil">Brazil</option>
														<option value="Brunei">Brunei</option>
														<option value="Bulgaria">Bulgaria</option>
														<option value="Burkina Faso">Burkina Faso</option>
														<option value="Burundi">Burundi</option>
														<option value="Cabo Verde">Cabo Verde</option>
														<option value="Cambodia">Cambodia</option>
														<option value="Cameroon">Cameroon</option>
														<option value="Canada">Canada</option>
														<option value="Central African Republic (CAR)">Central African Republic (CAR)</option>
														<option value="Chad">Chad</option>
														<option value="Chile">Chile</option>
														<option value="China">China</option>
														<option value="Colombia">Colombia</option>
														<option value="Comoros">Comoros</option>
														<option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
														<option value="Congo, Republic of the">Congo, Republic of the</option>
														<option value="Costa Rica">Costa Rica</option>
														<option value="Cote d'Ivoire">Cote d'Ivoire</option>
														<option value="Croatia">Croatia</option>
														<option value="Cuba">Cuba</option>
														<option value="Cyprus">Cyprus</option>
														<option value="Czechia">Czechia</option>
														<option value="Denmark">Denmark</option>
														<option value="Djibouti">Djibouti</option>
														<option value="Dominica">Dominica</option>
														<option value="Dominican Republic">Dominican Republic</option>
														<option value="Ecuador">Ecuador</option>
														<option value="Egypt">Egypt</option>
														<option value="El Salvador">El Salvador</option>
														<option value="Equatorial Guinea">Equatorial Guinea</option>
														<option value="Eritrea">Eritrea</option>
														<option value="Estonia">Estonia</option>
														<option value="Eswatini (formerly Swaziland)">Eswatini (formerly Swaziland)</option>
														<option value="Ethiopia">Ethiopia</option>
														<option value="Fiji">Fiji</option>
														<option value="Finland">Finland</option>
														<option value="France">France</option>
														<option value="Gabon">Gabon</option>
														<option value="Gambia">Gambia</option>
														<option value="Georgia">Georgia</option>
														<option value="Germany">Germany</option>
														<option value="Ghana">Ghana</option>
														<option value="Greece">Greece</option>
														<option value="Grenada">Grenada</option>
														<option value="Guatemala">Guatemala</option>
														<option value="Guinea">Guinea</option>
														<option value="Guinea-Bissau">Guinea-Bissau</option>
														<option value="Guyana">Guyana</option>
														<option value="Haiti">Haiti</option>
														<option value="Honduras">Honduras</option>
														<option value="Hungary">Hungary</option>
														<option value="Iceland">Iceland</option>
														<option value="India" selected="">India</option>
														<option value="Indonesia">Indonesia</option>
														<option value="Iran">Iran</option>
														<option value="Iraq">Iraq</option>
														<option value="Ireland">Ireland</option>
														<option value="Israel">Israel</option>
														<option value="Italy">Italy</option>
														<option value="Jamaica">Jamaica</option>
														<option value="Japan">Japan</option>
														<option value="Jordan">Jordan</option>
														<option value="Kazakhstan">Kazakhstan</option>
														<option value="Kenya">Kenya</option>
														<option value="Kiribati">Kiribati</option>
														<option value="Kosovo">Kosovo</option>
														<option value="Kuwait">Kuwait</option>
														<option value="Kyrgyzstan">Kyrgyzstan</option>
														<option value="Laos">Laos</option>
														<option value="Latvia">Latvia</option>
														<option value="Lebanon">Lebanon</option>
														<option value="Lesotho">Lesotho</option>
														<option value="Liberia">Liberia</option>
														<option value="Libya">Libya</option>
														<option value="Liechtenstein">Liechtenstein</option>
														<option value="Lithuania">Lithuania</option>
														<option value="Luxembourg">Luxembourg</option>
														<option value="Madagascar">Madagascar</option>
														<option value="Malawi">Malawi</option>
														<option value="Malaysia">Malaysia</option>
														<option value="Maldives">Maldives</option>
														<option value="Mali">Mali</option>
														<option value="Malta">Malta</option>
														<option value="Marshall Islands">Marshall Islands</option>
														<option value="Mauritania">Mauritania</option>
														<option value="Mauritius">Mauritius</option>
														<option value="Mexico">Mexico</option>
														<option value="Micronesia">Micronesia</option>
														<option value="Moldova">Moldova</option>
														<option value="Monaco">Monaco</option>
														<option value="Mongolia">Mongolia</option>
														<option value="Montenegro">Montenegro</option>
														<option value="Morocco">Morocco</option>
														<option value="Mozambique">Mozambique</option>
														<option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
														<option value="Namibia">Namibia</option>
														<option value="Nauru">Nauru</option>
														<option value="Nepal">Nepal</option>
														<option value="Netherlands">Netherlands</option>
														<option value="New Zealand">New Zealand</option>
														<option value="Nicaragua">Nicaragua</option>
														<option value="Niger">Niger</option>
														<option value="Nigeria">Nigeria</option>
														<option value="North Korea">North Korea</option>
														<option value="North Macedonia (formerly Macedonia)">North Macedonia (formerly Macedonia)</option>
														<option value="Norway">Norway</option>
														<option value="Oman">Oman</option>
														<option value="Pakistan">Pakistan</option>
														<option value="Palau">Palau</option>
														<option value="Palestine">Palestine</option>
														<option value="Panama">Panama</option>
														<option value="Papua New Guinea">Papua New Guinea</option>
														<option value="Paraguay">Paraguay</option>
														<option value="Peru">Peru</option>
														<option value="Philippines">Philippines</option>
														<option value="Poland">Poland</option>
														<option value="Portugal">Portugal</option>
														<option value="Qatar">Qatar</option>
														<option value="Romania">Romania</option>
														<option value="Russia">Russia</option>
														<option value="Rwanda">Rwanda</option>
														<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
														<option value="Saint Lucia">Saint Lucia</option>
														<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
														<option value="Samoa">Samoa</option>
														<option value="San Marino">San Marino</option>
														<option value="Sao Tome and Principe">Sao Tome and Principe</option>
														<option value="Saudi Arabia">Saudi Arabia</option>
														<option value="Senegal">Senegal</option>
														<option value="Serbia">Serbia</option>
														<option value="Seychelles">Seychelles</option>
														<option value="Sierra Leone">Sierra Leone</option>
														<option value="Singapore">Singapore</option>
														<option value="Slovakia">Slovakia</option>
														<option value="Slovenia">Slovenia</option>
														<option value="Solomon Islands">Solomon Islands</option>
														<option value="Somalia">Somalia</option>
														<option value="South Africa">South Africa</option>
														<option value="South Korea">South Korea</option>
														<option value="South Sudan">South Sudan</option>
														<option value="Spain">Spain</option>
														<option value="Sri Lanka">Sri Lanka</option>
														<option value="Sudan">Sudan</option>
														<option value="Suriname">Suriname</option>
														<option value="Sweden">Sweden</option>
														<option value="Switzerland">Switzerland</option>
														<option value="Syria">Syria</option>
														<option value="Taiwan">Taiwan</option>
														<option value="Tajikistan">Tajikistan</option>
														<option value="Tanzania">Tanzania</option>
														<option value="Thailand">Thailand</option>
														<option value="Timor-Leste">Timor-Leste</option>
														<option value="Togo">Togo</option>
														<option value="Tonga">Tonga</option>
														<option value="Trinidad and Tobago">Trinidad and Tobago</option>
														<option value="Tunisia">Tunisia</option>
														<option value="Turkey">Turkey</option>
														<option value="Turkmenistan">Turkmenistan</option>
														<option value="Tuvalu">Tuvalu</option>
														<option value="Uganda">Uganda</option>
														<option value="Ukraine">Ukraine</option>
														<option value="United Arab Emirates (UAE)">United Arab Emirates (UAE)</option>
														<option value="United Kingdom (UK)">United Kingdom (UK)</option>
														<option value="United States of America (USA)">United States of America (USA)</option>
														<option value="Uruguay">Uruguay</option>
														<option value="Uzbekistan">Uzbekistan</option>
														<option value="Vanuatu">Vanuatu</option>
														<option value="Vatican City (Holy See)">Vatican City (Holy See)</option>
														<option value="Venezuela">Venezuela</option>
														<option value="Vietnam">Vietnam</option>
														<option value="Yemen">Yemen</option>
														<option value="Zambia">Zambia</option>
														<option value="Zimbabwe">Zimbabwe</option>
													</select>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="category">Category</label>
													<div class="controls">
													<select class="form-control" id="category" name="category" required>
                                                        <option value="" disabled="" selected="">--Select--</option>
                        									<option value="APOS / TOS Member">APOS / TOS Member</option>
                        									<option value="Non APOS / TOS Member">Non APOS / TOS Member</option>
                        									<option value="PG Student">PG Student</option>
                        									<option value="APOS / TOS Member plus 1 Accompanying Person">APOS / TOS Member + 1 Accompanying Person</option>
                        									<option value="Non APOS / TOS Member plus 1 Accompanying Person">Non APOS / TOS Member + 1 Accompanying Person</option>
                        									<option value="PG Student plus 1 Accompanying Person">PG Student + 1 Accompanying Person</option>
                        									<option value="Senior Citizens above 70 or 75 years">Senior Citizens above 70 or 75 years</option>
                        									<option value="Guest Faculty">Guest Faculty</option>
                        									<option value="Managing Committee">Managing Committee</option>
                        									<option value="Executive Committee">Executive Committee</option>
                        								</select>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="paymode">Payment Mode</label>
													<div class="controls">
													<select class="form-control" id="paymode" name="paymode" required>
														<option value="" disabled >--Select--</option>
														<!--<option value="Online" >Online</option>-->
														<option value="Offline" >Offline</option>
													</select>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="amount">Amount</label>
													<span class="desc">e.g. "2000"</span>
													<div class="controls">
														<input type="text" class="form-control" id="amount" name="amount" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="transactionid">Transaction ID / Reference Id</label>
													<div class="controls">
														<input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
													</div>
												</div>											
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="field-1">Transaction Date</label>
													<div class="controls">
														<input type="text" class="form-control datepicker" id="transaction_date" name="transaction_date" data-format="dd/mm/yyyy" required>
													</div>
												</div>
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="form-label" for="field-1">Upload Receipt</label>
													<div class="controls">
														<input type="file" class="form-control" id="upload_receipt" name="upload_receipt" >
													</div>
												</div>
											</div>

											<div class="col-md-12 col-sm-12 col-xs-12">												
												<div class="pull-right">
													<button type="submit" class="btn btn-success">Save</button>
												</div>											
											</div>
												
											</form>

										</div>

                                    </div>
                                </div>
                            </div>
                        </section>
					</div>









                </section>
            </section>
            <!-- END CONTENT -->
			</div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include_once('bottom_link.php'); ?>
<script>
    $("form[name='registrationForm']").validate({
     //do nothing
    });
</script>


