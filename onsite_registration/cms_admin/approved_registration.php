<?php include_once('top_link.php'); ?>

            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Registration List</h1>                           
							</div>
                            <?php
				// 			$csv  = "Registered_List.csv";
						  //  $exportQuery = "SELECT reg.uid as `Registration ID`,reg.fullname as `Full Name`,reg.emailid as `Email ID`,reg.mobileno as `Mobile No`,reg.institute as `Institute`,reg.address as `Address`,reg.city as `City`,reg.state as `State`,reg.country as `Country`,reg.payment_mode as `Payment Mode`,reg.amount as `Amount`,reg.transaction_id as `Transaction Id`,reg.transaction_date as `Transaction Date`,reg_fee.category as `Reg Category` FROM registration as reg INNER JOIN registration_fee as reg_fee ON reg.category = reg_fee.id where reg.uid!='Pending Registartion';";
						    //$exportQuery = "SELECT reg.uid as `Registration ID`,reg.membership_no as `Membership No.`,reg.mci_no as `MCI No.`,reg.fullname as `Full Name`,reg.emailid as `Email ID`,reg.mobileno as `Mobile No`,reg_fee.category as `Reg Category`,reg.reg_category_type as `Reg Type`,reg.institute as `Institute`,reg.address as `Address`,reg.city as `City`,reg.state as `State`,reg.country as `Country`,reg.payment_mode as `Payment Mode`,reg.amount as `Amount`,reg.transaction_id as `Transaction Id`,reg.transaction_date as `Transaction Date` FROM registration as reg INNER JOIN registration_fee as reg_fee ON reg.category = reg_fee.id where reg.uid!='Pending Registartion';";
				            // 	$exportQuery = "SELECT abs.abstract_no as `Abstract No`, user.prefix as `Title Submitting Author`, user.firstname as `First Name Submitting Author`, user.lastname as `Last Name Submitting Author`, abs.email as `Email Submitting Author`, abs.reviewer_status as `Status(0=Pending Review, 1=Accepted, 2=Rejected, 3=Moved)`, abc.typename as `Parallel Session`, abst.typename as `Parallel Session Type`, abt.typename as `Abstract Type`, abs.title as `Abstract Title`, abs.description as `Abstract`, coauthors.title as `Title Presenting Author`, coauthors.fname as `First Name Presenting Author`, coauthors.lname as `Last Name Presenting Author`, coauthors.email as `Email Presenting Author`, coauthors.affiliation as `Affiliation`, coauthors.is_presenting as `Is Presenting(0=No, 1=Yes)` FROM `coauthors` inner join registration as abs on abs.id=coauthors.abs_id inner join registration as abc on abs.category=abc.id left join abstract_session_type as abst on abs.abs_session_type=abst.id inner join abstract_type as abt on abt.id=abs.abs_type inner join user on user.email=abs.email";
						    //  $exportQuery = "SELECT * FROM `registration` where uid='Pending Registration'";
				// 			include_once("approvedexport.php");
							?>

                            <div class="pull-right hidden-xs">
                               	<!--<a href="<?php echo $csv;?>" class="btn btn-primary float-right mt-2">Download CSV</a>-->
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>




                    <div class="col-lg-12">
                        <section class="box ">
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!-- ********************************************** -->

                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Action</th>
                                                    <th>Reg Id</th>
                                                    <th>Name</th>
                                                    <th>Email Id</th>
                                                    <th>Mobile No.</th>
                                                    <th>Category</th>
                                                    <th>Place / Company</th>
                                                    <!--<th>Paymode</th>-->
                                                    <!--<th>Transaction Id</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqry = mysqli_query($connect, "select * from delegate_list where 1");
                                                if (mysqli_num_rows($sqry) > 0) {
                                                    $count = 0;
                                                    while($resluts = mysqli_fetch_assoc($sqry)) {
                                                        $count++;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $count;?></td>
                                                    <td><a href="javascript:void(0);" id="sendMail" data-id="<?php echo $resluts['id'];?>" class="btn btn-orange"><i class="fa fa-envelope"></i></a></td>
                                                    <td><?php echo $resluts['unique_id'];?></td>
                                                    <td><?php echo $resluts['fullname'];?></td>
                                                    <td><?php echo $resluts['emailid'];?></td>
                                                    <td><?php echo $resluts['mobileno'];?></td>
                                                    <td><?php echo $resluts['reg_category'];?></td>
                                                    <td><?php echo $resluts['place'];?></td>
                                                    <!--<td><?php echo $resluts['payment_mode'];?></td>-->
                                                    <!--<td><?php echo $resluts['transaction_id'];?></td>-->
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
<script>
    $(document).on("click", "#viewDetails", function(){
        var fullname = $(this).data('details')['fullname'];
        var emailid = $(this).data('details')['emailid'];
        var mobileno = $(this).data('details')['mobileno'];
        var category = $(this).data('details')['category'];
        var amount = $(this).data('details')['amount'];
        var payment_mode = $(this).data('details')['payment_mode'];
        var transaction_id = $(this).data('details')['transaction_id'];
        var transaction_date = $(this).data('details')['transaction_date'];
        $(".modal-title").html(fullname);
        $("#fullname").val(fullname);
        $("#emailid").val(emailid);
        $("#mobileno").val(mobileno);
        $("#category").val(category);
        $("#amount").val(amount);
        $("#payment_mode").val(payment_mode);
        $("#transaction_id").val(transaction_id);
        $("#transaction_date").val(transaction_date);
    });
    
    $(document).on("click", "#sendMail", function(){
        var regId = $(this).data('id');
        
        $.ajax({
                url: "ajaxcall.php",
                type: "POST",             
                data: 'regId='+regId+'&sendMail_del=1',
                cache: false,
                success: function(data) {
        			  alert(data);
                }
            });
    })
</script>
<!-- modal start -->
                                        <div class="modal fade" id="view_details"  tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">View Details</h4>
                                                    </div>
                                                    <div class="modal-body">
														<form id="reg_validate" action="#" >
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field1" class="control-label">Name</label>
																		<input type="text" class="form-control" id="fullname" name="fullname" readonly>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field2" class="control-label">Email Id</label>
																		<input type="text" class="form-control" id="emailid" name="emailid" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Mobile No.</label>
																		<input type="text" class="form-control" id="mobileno" name="mobileno" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field4" class="control-label">Category</label>
																		<input type="text" class="form-control" id="category" name="category" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field5" class="control-label">Amount</label>
																		<input type="text" class="form-control" id="amount" name="amount" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Paymode</label>
																		<input type="text" class="form-control" id="payment_mode" name="payment_mode" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction ID / Reference Id</label>
																		<input type="text" class="form-control" id="transaction_id" name="transaction_id" readonly>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="field6" class="control-label">Transaction Date</label>
																		<input type="text" class="form-control" id="transaction_date" name="transaction_date" readonly>
																	</div>	
																</div>
															</div>												
														</form>
													</div>
                                            </div>
                                        </div>
                                        <!-- modal end -->


