<?php include_once('top_link.php'); ?>
<?php

if (isset($_POST['btnSubmit']) && !empty($_POST['assign_status'])) {
    $date_session = mysqli_real_escape_string($connect, $_POST['date_session']);
    $time_session = mysqli_real_escape_string($connect, $_POST['time_session']);
    $hall = mysqli_real_escape_string($connect, $_POST['hall']);
    $assign_status = mysqli_real_escape_string($connect, $_POST['assign_status']);
    $token = $_POST['absToken'];
    $sqry = mysqli_query($connect, "select * from abstract_submission where token='$token'");
    if (mysqli_num_rows($sqry) > 0) {
        
        mysqli_query($connect, "update abstract_submission set assign_status='$assign_status', hall='$hall', time_session='$time_session', date_session='$date_session' where token='$token'");
        $resluts = mysqli_fetch_assoc($sqry);
        $fullname = $resluts['presenter_name'];
        $absid = $resluts['abstract_no'];
        $email = $resluts['registered_emailid'];
        $mobileno = $resluts['mobile_no'];
        $regid = $resluts['registration_id'];
        $abs_category = $resluts['abs_category'];
        $abs_type = $resluts['abs_type'];
        $time_session = $resluts['time_session'];
        $date_session = $resluts['date_session'];
        $hall = $resluts['hall'];
        $title = $resluts['title'];
        $fp_type = $resluts['fp_type'];
        $approved_for = $resluts['approved_for'];
        $html="<strong>Dear $fullname</strong>, 
               <br><br>
              <b>Please find your Abstract details as mentioned below:</b><br>
              <b>Abstract No</b> - $absid<br>
              <b>Presenter Name</b> - $fullname<br>
              <b>Email ID</b> - $email<br>
              <b>Mobile No</b> - $mobileno<br>
              <b>Category</b> - $abs_type<br>
              <b>Type</b> - $fp_type<br>
              <b>Title</b> - $title<br>
              <b>Date</b> - $date_session<br>
              <b>Hall</b> - $hall<br>
              <b>Timing</b> - $time_session<br>
              <b>Approved For</b> - $approved_for";
                                                
            $subject="Allocation of Timing @ ".$event_name;
            $db->sendMail($subject,$html, $email, $applicant_name, $mail_header,$mail_footer, $event_name);
            $_SESSION['successMsg'] = "Allocation of Schedule successfully";
            echo '<script>location.href="approved_abstracts.php";</script>';
            // echo '<script>location.href="approved_abstracts.php";</script>';
            exit();
    } else {
        echo '<script>location.href="approved_abstracts.php";</script>';
        exit();
    }
    
}


if (isset($_REQUEST['token']) && !empty($_REQUEST['token'])) {
    $token = $_REQUEST['token'];
    $sqry = mysqli_query($connect, "select * from abstract_submission where token='$token'");
    if (mysqli_num_rows($sqry) > 0) {
        $resluts = mysqli_fetch_assoc($sqry);
    } else {
        echo '<script>location.href="approved_abstracts.php";</script>';
        exit();
    }
} else {
    echo '<script>location.href="approved_abstracts.php";</script>';
    exit();
}
?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Abstract Details</h1>                           
							</div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="#"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li class="active">
                                        <strong>Abstract Details</strong>
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
                                        <form method="post">
                                            <input type="hidden" name="absToken" value="<?php echo $resluts['token'];?>" />
                                       <input type="hidden" name="assign_status" value="1" />
                                       <p style="line-height: 3;">Abstract No : <?php echo $resluts['abstract_no'];?><br>
                                       Presenter Name : <?php echo $resluts['presenter_name'];?><br>
                                       Institute : <?php echo $resluts['institute'];?><br>
                                       Email : <?php echo $resluts['registered_emailid'];?><br>
                                       Mobile : <?php echo $resluts['mobile_no'];?><br>
                                       Type : <?php echo $resluts['abs_type'];?><br>
                                       Category : <?php echo $resluts['fp_type'];?><br>
                                       Title : <?php echo $resluts['title'];?><br>
                                       Approved For : <?php echo $resluts['approved_for'];?><br>
                                       Abstract Description : <a href="<?php echo '../'.$resluts['upload_abstract'];?>" target="_blank" class="btn btn-info">View</a><br></p>
                                       <?php if ($resluts['assign_status']=='0') { ?>
										<div class="col-md-4 col-sm-4 col-xs-4">									
											<div class="form-group">
												<label class="form-label" for="date_session">Date</label>
													<select class="form-control" id="date_session" name="date_session" required>
													   <option value="">---Select---</option>
													   <option value="14 October 2022">14 October 2022</option>
													   <option value="15 October 2022">15 October 2022</option>
													   <option value="16 October 2022">16 October 2022</option>
												   </select>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">									
											<div class="form-group">
												<label class="form-label" for="time_session">Timing</label>
												<input type="text" class="form-control" id="time_session" name="time_session" required>
													<!--<select class="form-control" id="time_session" name="time_session" required>-->
													<!--   <option value="">---Select---</option>-->
													<!--   <option value="14 October 2022">14 October 2022</option>-->
													<!--   <option value="15 October 2022">15 October 2022</option>-->
													<!--   <option value="16 October 2022">16 October 2022</option>-->
												 <!--  </select>-->
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">									
											<div class="form-group">
												<label class="form-label" for="hall">Hall</label>
												<input type="text" class="form-control" id="hall" name="hall" required>
													<!--<select class="form-control" id="time_session" name="time_session" required>-->
													<!--   <option value="">---Select---</option>-->
													<!--   <option value="14 October 2022">14 October 2022</option>-->
													<!--   <option value="15 October 2022">15 October 2022</option>-->
													<!--   <option value="16 October 2022">16 October 2022</option>-->
												 <!--  </select>-->
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">												
											<div class="pull-right">
												<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" class="btn btn-success"/>
											</div>
										</div>
                                       <?php } ?>
                                       </form>
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
    
    $(".approved").hide();
    
    $(function() {
    // $('#row_dim').hide(); 
    $('#status').change(function(){
        if($('#status').val() == 'Approve') {
            $('.approved').show(); 
        } else {
            $('.approved').hide(); 
        } 
    });
});
</script>