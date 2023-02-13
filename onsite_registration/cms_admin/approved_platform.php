<?php include_once('top_link.php'); 
if (isset($_REQUEST['abs_category']) && !empty($_REQUEST['abs_category'])) {
    $abs_category = $_REQUEST['abs_category'];
    $sqry = mysqli_query($connect, "select * from abstract_submission where abs_category='$abs_category'");
    if (mysqli_num_rows($sqry) > 0) {
        $resluts = mysqli_fetch_assoc($sqry);
    } else {
        echo '<script>location.href="pending_abstracts.php";</script>';
        exit();
    }
} else {
    echo '<script>location.href="pending_abstracts.php";</script>';
    exit();
}
?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Approved Platform (<?php echo $abs_category;?>)</h1>                           
							</div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="#"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li class="active">
                                        <strong>Approved Platform</strong>
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
                                                    <th>View Abstract</th>
                                                    <th>Name</th>
                                                    <th>Abstract No</th>
                                                    <th>Approved For</th>
                                                    <th>Abs Category</th>
                                                    <th>Title</th>
                                                    <!--<th>Email Id</th>-->
                                                    <!--<th>Mobile No.</th>-->
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqry = mysqli_query($connect, "select * from abstract_submission where abs_category='$abs_category' and approved_for='Platform' and status='Approve'");
                                                if (mysqli_num_rows($sqry) > 0) {
                                                    $count = 0;
                                                    while($resluts = mysqli_fetch_assoc($sqry)) {
                                                        $count++;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $count;?></td>
                                                    <td><a href="<?php echo '../'.$resluts['upload_abstract'];?>" target="_blank" class="btn btn-info">View</a></td>
                                                    <!--<td><a href="abstract_details.php?token=<?php echo $resluts['token'];?>"  id="viewDetails" class="btn btn-info"><i class="fa fa-eye"></i></a>-->
                                                    <!--</td>-->
                                                    <td><?php echo $resluts['presenter_name'];?></td>
                                                    <td><?php echo $resluts['abstract_no'];?></td>
                                                    <td><?php echo $resluts['approved_for'];?></td>
                                                    <td><?php echo $resluts['abs_category'];?></td>
                                                    <td><?php echo $resluts['title'];?></td>
                                                    <!--<td><?php echo $resluts['registered_emailid'];?></td>-->
                                                    <!--<td><?php echo $resluts['mobile_no'];?></td>-->
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
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Mobile No.</label>
																		<input type="text" class="form-control mobileno" id="mobileno" name="mobileno" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Category</label>
																		<input type="text" class="form-control category" id="category" name="category" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field5" class="control-label">Amount</label>
																		<input type="text" class="form-control amount" id="amount" name="amount" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
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
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Mobile No.</label>
																		<input type="text" class="form-control mobileno" id="mobileno" name="mobileno" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Category</label>
																		<input type="text" class="form-control category" id="category" name="category" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field5" class="control-label">Amount</label>
																		<input type="text" class="form-control amount" id="amount" name="amount" required>
																	</div>	
																</div>
																<div class="col-md-6">
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
        var delegateid = $(this).data('details')['id'];
        var fullname = $(this).data('details')['fullname'];
        var emailid = $(this).data('details')['emailid'];
        var mobileno = $(this).data('details')['mobileno'];
        var category = $(this).data('details')['category'];
        var amount = $(this).data('details')['amount'];
        var payment_mode = $(this).data('details')['payment_mode'];
        var transaction_id = $(this).data('details')['transaction_id'];
        var transaction_date = $(this).data('details')['transaction_date'];
        $(".modal-title").html(fullname);
        $(".fullname").val(fullname);
        $(".emailid").val(emailid);
        $(".mobileno").val(mobileno);
        $(".category").val(category);
        $(".amount").val(amount);
        $(".payment_mode").val(payment_mode);
        $(".transaction_id").val(transaction_id);
        $(".transaction_date").val(transaction_date);
        $(".delegateid").val(delegateid);
    });
    
    $("form[name='paymentForm']").validate({
    });
</script>
                                        
                                        