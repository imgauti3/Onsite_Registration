<?php include_once('top_link.php'); ?>
<?php

if (isset($_POST['btnSubmit']) && !empty($_POST['status'])) {
    $approved_for = mysqli_real_escape_string($connect, $_POST['approved_for']);
    $reviewer_name = mysqli_real_escape_string($connect, $_POST['reviewer_name']);
    $status = mysqli_real_escape_string($connect, $_POST['status']);
    $token = $_POST['absToken'];
    $sqry = mysqli_query($connect, "select * from abstract_submission where token='$token'");
    if (mysqli_num_rows($sqry) > 0) {
        
        mysqli_query($connect, "update abstract_submission set status='$status', approved_for='$approved_for', reviewer_name='$reviewer_name' where token='$token'");
        $resluts = mysqli_fetch_assoc($sqry);
        $fullname = $resluts['presenter_name'];
        $absid = $resluts['abstract_no'];
        $email = $resluts['registered_emailid'];
        $mobileno = $resluts['mobile_no'];
        $regid = $resluts['registration_id'];
        $abs_category = $resluts['abs_category'];
        $title = $resluts['title'];
        $html="<strong>Dear $fullname</strong>, 
               <br><br>
               <b>Author must be registered for the conference to present</b><br><br>
              <b>Please find your Abstract details as mentioned below:</b><br>
              <b>Abstract No</b> - $absid<br>
              <b>Presenter Name</b> - $fullname<br>
              <b>Email ID</b> - $email<br>
              <b>Mobile No</b> - $mobileno<br>
              <b>Title</b> - $title<br>";
              if ($status == 'Approve') {
              $html.="<b>Approved For</b> - $approved_for<br>
              <b>Status</b> - $status<br>";
              } else {
                $html.="<b>Status</b> - $status";
              }
              if ($approved_for == 'E-Poster Presentation') {
              $html.="<b>We have send brief guidelines like for e-posters <br>
                        1. Prepare in power point format not more than 5 slides including title slide. <br>
                        2. Presentation will be played either online or physically in the wetlab area all three days</b>";
              } else {
                $html.="<b></b>";
              }
                                                
            $subject="Abstract @ ".$event_name;
            $db->sendMail($subject,$html, $email, $applicant_name, $mail_header,$mail_footer1, $event_name);
            $_SESSION['successMsg'] = "Abstract has been approved successfully";
            echo '<script>location.href="pending_abstracts.php";</script>';
            // echo '<script>location.href="approved_abstracts.php";</script>';
            exit();
    } else {
        echo '<script>location.href="pending_abstracts.php";</script>';
        exit();
    }
    
}


if (isset($_REQUEST['token']) && !empty($_REQUEST['token'])) {
    $token = $_REQUEST['token'];
    $sqry = mysqli_query($connect, "select * from abstract_submission where token='$token'");
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
                                       <p style="line-height: 3;">Abstract No : <?php echo $resluts['abstract_no'];?><br>
                                       Presenter Name : <?php echo $resluts['presenter_name'];?><br>
                                       Institute : <?php echo $resluts['institute'];?><br>
                                       Email : <?php echo $resluts['registered_emailid'];?><br>
                                       Mobile : <?php echo $resluts['mobile_no'];?><br>
                                       Type : <?php echo $resluts['abs_type'];?><br>
                                       Paper Type : <?php echo $resluts['fp_type'];?><br>
                                       <?php if($resluts['fp_type']=='Competitive') { ?>
                                       Category : <?php echo $resluts['competitive_type'];?><br>
                                       <?php } ?>
                                       Title : <?php echo $resluts['title'];?><br>
                                       Abstract Description : <a href="<?php echo '../'.$resluts['upload_abstract'];?>" target="_blank" class="btn btn-info">View</a><br></p>
                                       <?php if ($resluts['status']=='pending') { ?>
										<div class="col-md-4 col-sm-4 col-xs-4">									
											<div class="form-group">
												<label class="form-label" for="status">Approved For</label>
													<select class="form-control" id="status" name="status" required>
													   <option value="">---Select---</option>
													   <option id="approved" value="Approve">Approve</option>
													   <option id="reject" value="Reject">Reject</option>
												   </select>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 approved">									
											<div class="form-group">
												<label class="form-label" for="approved_for">Approved Category</label>
													<select class="form-control" id="approved_for" name="approved_for" >
														<option value="" disabled selected="">--Select--</option>
														<option value="Oral Presentation">Oral Presentation</option>
														<option value="Free Paper Presentation">Free Paper Presentation</option>
														<option value="Poster Presentation">Poster Presentation</option>
														<option value="E-Poster Presentation">E-Poster Presentation</option>
														<option value="Instruction Courses">Instruction Courses</option>
													</select>
													<!--<input type="text" class="form-control" id="approved_for" name="approved_for" required>
													<select class="form-control" id="approved_for" name="approved_for">
													   <option value="">---Select---</option>
													   <option value="1">Approve</option>
												   </select>-->
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 approved">									
											<div class="form-group">
												<label class="form-label" for="reviewer_name">Reviewer Name</label>
													<input type="text" class="form-control" id="reviewer_name" name="reviewer_name" >
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