<?php include_once('top_link.php'); ?>
<?php
if (isset($_POST['delegateid']) && !empty($_POST['emailid'])) {
    $delegateid = $_POST['delegateid'];
    $emailid = $_POST['emailid'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $transaction_id = $_POST['transaction_id'];
    $transaction_date = $_POST['transaction_date'];
    
    $regstatus = $db->genAppId();
        
    $uqry = mysqli_query($connect, "update registration set  uid='$regstatus', payment_mode='$payment_mode', transaction_id='$transaction_id', transaction_date='$transaction_date', payment_status='1', amount='$amount' where id=$delegateid and emailid='$emailid'");

        if ($uqry) {
            
            $sqry = mysqli_query($connect, "select * from registration where id='$delegateid'");
            if (mysqli_num_rows($sqry) > 0) {
                    $results = mysqli_fetch_assoc($sqry);
                    $fullname = $results['fullname'];
                    $email = $results['emailid'];
                    $mobile = $results['mobileno'];
                    $category = $resluts['category'];
                    $categorytext = $db->getFieldValue('registration_fee', 'category', 'id', $category);
                    $reg_type = $resluts['reg_category_type'];
                    $reg_typetext = $db->getFieldValue('reg_type_fee', 'category', 'id', $reg_type);
                    // $category = $results['category'];
                    $uid = $results['uid'];
                		    
            	    $html="<strong>Dear $fullname</strong>, <br>
                  <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
                   <br><br>
                  <b>Please find your registration details as mentioned below:</b><br>
                  <b>Full Name</b> - $fullname<br>
                  <b>Email ID</b> - $email<br>
                  <b>Mobile No</b> - $mobile<br>
                  <b>Registration ID</b> - $uid<br>
                  <b>Category</b> - $categorytext<br>
                  <b>Registration Type</b> - $reg_typetext<br>
                  <b>Amount</b> - $amount<br>
                  <b>Payment Mode</b> - $payment_mode<br>
                  <b>Transaction ID</b> - $transaction_id<br>
                  <b>Payment Date</b> - $transaction_date<br>
                  <b>Payment Status</b> - Success";
                		    
                    $subject="Registration Status to ".$event_name;
                    $db->sendMail($subject,$html, $email, $fullname, $mail_header,$mail_footer, $event_name);
                    
                    $_SESSION['successMsg'] = "Payment deatils has been updated successful.";
            }
        } else {
            $_SESSION['errorMsg'] = "Something went wrong please try again.";
        }
        echo '<script>location.href="promocode_users.php";</script>';
        exit();
}
?>

            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Promocode Registration</h1>                           
							</div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="#"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li class="active">
                                        <strong>Promocode Registration</strong>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>




                    <div class="col-lg-12">
                        <section class="box ">
                            <div class="content-body">    <div class="row">
                                
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!-- ********************************************** -->

                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Action</th>
                                                    <th>Reg ID</th>
                                                    <th>Name</th>
                                                    <th>Email Id</th>
                                                    <th>Mobile No.</th>
                                                    <th>Category</th>
                                                    <th>Promocode</th>
                                                    <th>Institute / Organisation</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqry = mysqli_query($connect, "select * from registration where promocode <> '' and promocode <>'NA'");
                                                if (mysqli_num_rows($sqry) > 0) {
                                                    $count = 0;
                                                    while($resluts = mysqli_fetch_assoc($sqry)) {
                                                        $count++;
                                                    $category = $resluts['category'];
                                                    $categorytext = $db->getFieldValue('registration_fee', 'category', 'id', $category);
                                                    $reg_type = $resluts['reg_category_type'];
                                                    $reg_typetext = $db->getFieldValue('reg_type_fee', 'category', 'id', $reg_type);
                                                    // $fullcategory = $categorytext($reg_type);
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $count;?></td>
                                                    <td><a title="View Details" data-toggle="modal" id="viewDetails" href="#view_details" data-id="<?php echo $resluts['id'];?>" data-fullname="<?php echo $resluts['fullname'];?>" data-emailid="<?php echo $resluts['emailid'];?>" data-mobileno="<?php echo $resluts['mobileno'];?>" data-category="<?php echo $resluts['category'];?>"  data-namecategory="<?php echo $categorytext;?> <?php echo $reg_typetext;?>" data-amount="<?php echo $resluts['amount'];?>" data-payment_mode="<?php echo $resluts['payment_mode'];?>" data-transaction_id="<?php echo $resluts['transaction_id'];?>" data-transaction_date="<?php echo $resluts['transaction_date'];?>" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                <?php if($resluts['uid'] == 'Pending Registartion') { ?>
                                                    <a title="Got Payment" data-toggle="modal" id="gotPayment" href="#got_payment" data-id="<?php echo $resluts['id'];?>" data-fullname="<?php echo $resluts['fullname'];?>" data-emailid="<?php echo $resluts['emailid'];?>" data-mobileno="<?php echo $resluts['mobileno'];?>" data-category="<?php echo $resluts['category'];?>"  data-namecategory="<?php echo $categorytext;?> <?php echo $reg_typetext;?>" data-amount="<?php echo $resluts['amount'];?>" data-payment_mode="<?php echo $resluts['payment_mode'];?>" data-transaction_id="<?php echo $resluts['transaction_id'];?>" data-transaction_date="<?php echo $resluts['transaction_date'];?>" class="btn btn-success"><i class="fa fa-credit-card"></i></a>
                                                <?php } else { } ?>
                                                    
                                                    </td>
                                                    <td><?php echo $resluts['uid'];?></td>
                                                    <td><?php echo $resluts['fullname'];?></td>
                                                    <td><?php echo $resluts['emailid'];?></td>
                                                    <td><?php echo $resluts['mobileno'];?></td>
                                                    <td><?php echo $categorytext;?> <?php echo $reg_typetext;?></td>
                                                    <td><?php echo $resluts['promocode'];?></td>
                                                    <td><?php echo $resluts['institute'];?></td>
                                                </tr>
                                                <?php } } else {
                                                    echo 'No records found.';
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>

                                        <!--  *********************************************** -->

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
<!-- modal start -->


<!-- modal start -->
                                        <div class="modal fade" id="view_details"  tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">View Details</h4>
                                                    </div>
                                                    <div class="modal-body">
														
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field1" class="control-label">Name</label>
																		<input type="text" class="form-control fullname" id="fullname" name="fullname" readonly>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field2" class="control-label">Email Id</label>
																		<input type="text" class="form-control emailid" id="emailid" name="emailid" readonly>
																	</div>	
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="field4" class="control-label">Category</label>
																		<input type="text" class="form-control namecategory" id="category" name="category" readonly>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field4" class="control-label">Mobile No.</label>
																		<input type="text" class="form-control mobileno" id="mobileno" name="mobileno" readonly>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field5" class="control-label">Amount</label>
																		<input type="text" class="form-control amount" id="amount" name="amount" readonly>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field6" class="control-label">Paymode</label>
																		<input type="text" class="form-control payment_mode" id="payment_mode" name="payment_mode" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction ID / Reference Id</label>
																		<input type="text" class="form-control transaction_id" id="transaction_id" name="transaction_id" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction Date</label>
																		<input type="text" class="form-control transaction_date" id="transaction_date" name="transaction_date" readonly>
																	</div>	
																</div>
															</div>												
														
													</div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- modal end -->
                                        
                                        <!-- modal start -->
                                        <div class="modal fade" id="got_payment"  tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">View Details</h4>
                                                    </div>
                                                    <div class="modal-body">
														<form id="paymentForm" name="paymentForm" method="post">
														    
															<div class="row">
															    <input type="hidden" value="" id="delegateid" name="delegateid" class="delegateid"/>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field1" class="control-label">Name</label>
																		<input type="text" class="form-control fullname" id="fullname" name="fullname" readonly>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field2" class="control-label">Email Id</label>
																		<input type="text" class="form-control emailid" id="emailid" name="emailid" readonly>
																	</div>	
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="field4" class="control-label">Category</label>
																		<input type="text" class="form-control namecategory" id="category" name="category" readonly>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field4" class="control-label">Mobile No.</label>
																		<input type="text" class="form-control mobileno" id="mobileno" name="mobileno" readonly>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field5" class="control-label">Amount</label>
																		<input type="text" class="form-control amount" id="amount" name="amount" required>
																	</div>	
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="field6" class="control-label">Paymode</label>
																		<select type="text" class="form-control payment_mode" id="payment_mode" name="payment_mode" required>
																		    <option value="Offline">Offline</option>
																		    <option value="Online">Online</option>
																		    </select>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction ID / Reference Id</label>
																		<input type="text" class="form-control transaction_id" id="transaction_id" name="transaction_id" required>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction Date</label>
																		<input type="text" class="form-control transaction_date" id="transaction_date" name="transaction_date" required>
																	</div>
																</div>
																
																<div class="col-md-12 col-sm-12 col-xs-12">			
                    												<div class="pull-right">
                    													<button type="submit" class="btn btn-success">Save</button>
                    												</div>											
                    											</div>
																
															</div>												
														</form>
													</div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- modal end -->
                                        
                                        <script>
    $(document).on("click", "#viewDetails, #gotPayment", function(){
        var delegateid = $(this).data('id');
        var fullname = $(this).data('fullname');
        var emailid = $(this).data('emailid');
        var mobileno = $(this).data('mobileno');
        var category = $(this).data('category');
        var namecategory = $(this).data('namecategory');
        var amount = $(this).data('amount');
        var payment_mode = $(this).data('payment_mode');
        var transaction_id = $(this).data('transaction_id');
        var transaction_date = $(this).data('transaction_date');
        $(".modal-title").html(fullname);
        $(".fullname").val(fullname);
        $(".emailid").val(emailid);
        $(".mobileno").val(mobileno);
        $(".category").val(category);
        $(".namecategory").val(namecategory);
        $(".amount").val(amount);
        $(".payment_mode").val(payment_mode);
        $(".transaction_id").val(transaction_id);
        $(".transaction_date").val(transaction_date);
        $(".delegateid").val(delegateid);
    });
    
    $("form[name='paymentForm']").validate({
    });
</script>
                                        
                                        