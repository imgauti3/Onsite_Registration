<?php
@session_start();
include_once("db.php");
?>
<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>VDO | Onsite Registration Software</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
	

		<style>
			.select-method-wrap .select-method{
				width: 90px;
    			height: 90px;
				padding: 10px;
				border-radius: 50%;
				margin: 20px auto;
				background-color: #FFFFFF;
				color: #000000 !important;
				display: flex;
				align-items: center;
				justify-content: center;
				cursor: pointer;
			}
			.select-method-wrap input:checked ~ .select-method{
				background-color: #FF9F36;
				color: #FFFFFF;
			}
		</style>
	</head>
	<body>
	<canvas id="canvas"></canvas>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
<?php
if (isset($_POST['btnSubmit']) && !empty($_POST['hiddenid'])) {
    $hiddenid = mysqli_real_escape_string($connect, $_POST['hiddenid']);
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $emailid = mysqli_real_escape_string($connect, $_POST['emailid']);
    $mobileno = mysqli_real_escape_string($connect, $_POST['mobileno']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $place = mysqli_real_escape_string($connect, $_POST['place']);
    $reference_note = mysqli_real_escape_string($connect, $_POST['reference_note']);
    
    $data = "";
    
    $check=mysqli_query($connect,"select * from allow_not_allowed");
    while($res=mysqli_fetch_assoc($check))
    {
    	$chekval = in_array($res["type_name"], $_POST['check'])?0:1;
    	$data.= $res["type_name"].'='.$chekval.',';
    }
   
    
    // $kit = mysqli_real_escape_string($connect, $_POST['kit']);
    // $certificate_printed = mysqli_real_escape_string($connect, $_POST['certificate_printed']);
    // $day1_lunch = mysqli_real_escape_string($connect, $_POST['day1_lunch']);
    // $certificate = mysqli_real_escape_string($connect, $_POST['day1_dinner']);
    // $certificate = mysqli_real_escape_string($connect, $_POST['day2_lunch']);
    
    //$unique_id = $db->generateRandomString(6);
    
    // echo "update delegate_list set fullname='$fname', emailid='$emailid', mobileno='$mobileno', reg_category='$category', place='$place', $data reference_note='$reference_note'  where id=$hiddenid";
    // die();
    
    $uqry = mysqli_query($connect, "update delegate_list set fullname='$fname', certificate_name='$fname', certificate_printed=1, emailid='$emailid', mobileno='$mobileno', reg_category='$category', place='$place', $data reference_note='$reference_note'  where id=$hiddenid");
    if ($uqry) {
        $_SESSION['successMsg'] = 'Record has been updated successfully.';
    } else {
        $_SESSION['errorMsg'] = 'Something went wrong. Please try again later.';
    }
    echo "<script>location.href='registered_list.php';</script>";
    exit();
}
?>

<style>
    @page{
      size: auto;
      margin: 0mm;
    }
    @media print {
        html, body {
            width: auto;
            height: 99%;

        }
        .main-wrapper {
            display:none;
        }
        #printSection, #printSection * {
            visibility:visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
    }
</style>

			<!-- -->
			<div class="appmt-form doctors-col" style="background-image: url('bg.jpg');background-repeat: no-repeat;background-size: 100% 100%;padding:200px 0px 400px;">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
					    <img src="head2.png" style="width:500px;">
						<!--<h2>Badge Printing</h2>-->
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

						   <div class="form-group">
								<div class="row justify-content-center"> 
									<div class="col-sm-auto text-center"> 
										<div class="select-method-wrap">
											<input type="radio" name="mode" class="mode" value="Manual" id="manualMethod"  hidden>
											<label for="manualMethod" class="mb-0 select-method"> 
												<span style="font-size: 16px;font-weight: 500;"> Manual Check-in</span>
											</label>
										</div>
									</div>
									<div class="col-sm-auto text-center">
										 
										<div class="select-method-wrap">
											<input type="radio" name="mode" class="mode" value="Auto" id="autoMethod" hidden checked>
											<label for="autoMethod" class="mb-0 select-method"> 
												<span style="font-size: 16px;font-weight: 500;"> Auto Check-in</span>
											</label>
										</div>
									</div> 
								</div>
							</div>
						   
							<div class="row">
							<div class="col-12 col-md-12 col-lg-3"></div>
								<div class="col-12 col-md-12 col-lg-6 manual_div" style="display:none">
									<!--<input type="button" class="btn btn-primary" value="Selected Print">-->
									<div class="form-group">
										<label>Enter Your Name</label>
										<div style="position: relative;">
										<input type="text" class="form-control" id="search" name="search" placeholder="Search...." required="">
										<div style="position: absolute;right: 5px;top: 5px;" id="submitBtn"></div>
										</div>
										<div class="datarowcls" style="display:none;background: white;">
											<div class="regData">
											</div>
										</div>
									</div>
								</div>							
								<div class="col-12 col-md-12 col-lg-6 auto_div" style="display: none;" >
									
								</div>							
							</div>
							
					<!--<div class="row">-->
					<!--	<div class="col-sm-12">-->
					<!--		<div class="card">-->
					<!--			<div class="card-body">-->
					<!--				<div class="table-responsive">-->
					<!--					<table class="datatable table table-hover table-center mb-0">-->
					<!--						<thead>-->
					<!--							<tr>-->
					<!--								<th>Sno</th>-->
					<!--								<th>Actions</th>-->
					<!--								<th>Unique ID</th>-->
					<!--								<th>Category</th>-->
					<!--								<th>Full Name</th>-->
													<!--<th>Workshop</th>-->
					<!--								<th>Ref No.</th>-->
					<!--								<th>Mobile No.</th>-->
					<!--							</tr>-->
					<!--						</thead>-->
					<!--						<tbody class="regData">-->
					<!--						</tbody>-->
					<!--					</table>-->
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--	</div>			-->
					<!--</div>-->
				
					<?php
			
			$print=$db->getRows('badge_print_setup',array());
			
			echo "<div class='container printdatanew'>
			<div class='row' id='badge'>
				<div class='col-md-4'></div>
				<div class='col-md-4' style='background: white;box-shadow: 0px 1px 5px #888888;'>
					<div class='top'>
					</div>
					<div class='qr-new-content' style='text-align:center;'>
					</div>
					<div class='bottom'>
					</div>
				</div>
				<div class='col-md-4'></div>
			</div>
		</div>";
			?>
			
						</div>
					</div>
				</div>				
			</div>
			<!-- / -->
			
	<?php include_once('footer.php'); ?>
<div class="modal fade" id="userModalPopupForQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body printUserDetails">
        
      </div>
    </div>
  </div>
</div>
				<!-- jQuery -->
		<!--	<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/slick.js"></script>
		<script src="assets/js/script.js"></script>
		
	</body>
</html>-->

		<script src="assets/js/instascan.min.js"></script>
			
			<?php
			
      $print=$db->getRows('badge_print_setup',array());
    
    echo "<div class='container printdata'>
            <div class='row' id='badge'><div class='col-md-4'></div>
			    <div class='col-md-4'>
                <div class='top'  style='margin-top:".($print[0]["top"]-1).$print[0]["metric"].";'>
                </div>
                <div class='qr-content' style='text-align:center;'>
                </div>
				<div class='bottom' style='margin-top:".$print[0]["bottom"].$print[0]["metric"].";'>
                </div>
				<div class='col-md-4' ></div>
                </div>
            </div>
            </div>";
    ?>
			
	<script>
		
			$(".footer").css('display','none');
			$(".feature-section").css('display','none');
			    	$(document).on("keyup","input[name='search']",function(){
                    var searchKey = $(this).val().toLowerCase();
                    var searchMode = $("#mode").val();//Auto  Manual
                    $("#mode").val('');
					$("#submitBtn").html('');
                    setTimeout(function () {
                        if(searchKey.length>3)
                        {
                            $.ajax({
                                type:"post",
                                url:"process_new.php",
                                data:"searchKey="+searchKey+"&search=1"+"&searchMode="+searchMode,
                                success:function(data){
                                  	$(".regData").html(data);
									$(".datarowcls").css('display','block');
									$("#mode").val('Manual');
                                }
                            });
                        }
                    }, 500);
            });
            $(document).on("click",".edit-record",function(){
               var main = $(this).data('rec');
                console.log(main['id']);
                var delname = main['fullname'];
                var delemail = main['emailid'];
                var delmobile = main['mobileno'];
                var delcategory = main['reg_category'];
                var delplace = main['place'];
                var delnote = main['reference_note'];
                var delid = main['id'];
                var delkitbag = main['kit'];
                var delcertificate_printed = main['certificate_printed'];
                
                var delday1_lunch = main['day1_lunch'];
                
                var delday1_dinner = main['day1_dinner'];
                var delday2_lunch = main['day2_lunch'];
                
                var kit_delivered_date = main['kit_delivered_date'];
                var certificate_printed_date = main['certificate_printed_date'];
               
                
                setTimeout(function () {
                    if(delkitbag == 0) {
                        $("#kit").prop("checked", true);
                    }
                    if(delcertificate_printed == 0) {
                        $("#certificate_printed").prop("checked", true);
                    }
                    if(delday1_lunch == 0) {
                        $("#day1_lunch").prop("checked", true);
                    }
                    if(delday1_dinner == 0) {
                        $("#day1_dinner").prop("checked", true);
                    }
                    if(delday2_lunch == 0) {
                        $("#day2_lunch").prop("checked", true);
                    }
                    
                    if (kit_delivered_date) {
                        $("#kit").prop("disabled", true);
                    }
                    if (certificate_printed_date) {
                        $("#certificate_printed").prop("disabled", true);
                    }
                    
                }, 500);
                
                $("#fname").val(delname);
                $("#emailid").val(delemail);
                $("#mobileno").val(delmobile);
                $("#category").val(delcategory);
                $("#place").val(delplace);
                $("#reference_note").val(delnote);
                $("#hiddenid").val(delid);
            });
            
            
            $(document).on("click",".print",function(){
                var delid = $(this).data("id");
                $("#hiddenid").val(delid);
                $.ajax({
                    type:"post",
                    url:"barcode/generate.php",
                    data:{uid:$(this).data("id"),img_type:'<?=$print[0]["img_type"]; ?>'},
                    success:function(data){
						$("#userModalPopupForQr").modal("hide");
                        $(".qr-content").html(data);
                        setTimeout(function(){
                            window.print();
        					self.close();
                            $(".qr-content").html('');
                        },1000);
                        
                    }
                });
            });

            $(document).on("click",".userViewModal",function(){
                var delid = $(this).data("id");
                var name = $(this).data("name");
				// $('#userDetailModalView').modal('show');
				$('#search').val(name);
				$('#search').html(name);
     			$(".regData").html('');
				var data = "<button type='' class='submitBtnModal btn btn-success' data-id='"+delid+"'>Submit</button>";
				$("#submitBtn").html(data);
            });
            $(document).on("click",".submitBtnModal",function(){
                var delid = $(this).data("id");
                $.ajax({
                    type:"post",
                    url:"barcode/user_generate_view.php",
                    data:{uid:$(this).data("id"),img_type:'<?=$print[0]["img_type"]; ?>'},
                    success:function(data){
						$("#userModalPopupForQr").modal("show");
						$(".printUserDetails").html(data);
						$(".qr-content").html(data);
                    }
                });
            });
            
var media = window.matchMedia('print');
media.addListener(function(mql) {
    if (!mql.matches) {
        if (confirm("Have you Printed Badge?")) {
            var delid = $("#hiddenid").val();
            $.ajax({
                type:"post",
                url:"process.php",
                data:{uid:delid,print:true},
                success:function(data){
                  if(data)
                  {
                      //remove search tag value and search mode
                      $("#search").val('');
                      //$("#mode").val('');
                      $("a[data-id='"+delid+"']").removeClass("btn-success").addClass("btn-danger").text("Printed");
                      ajaxCall();
					}
					// location.reload();
					window.location.href = 'thankyoupage.php?uniquId='+delid;
                }
				
            });
        }
        else
        {
        	location.reload();
        }
    }
});

$(".mode").change(function(){
	var mode= this.value;
	if(mode == "Manual")
	{
		$(".manual_div").css("display","block");
		$(".auto_div").css("display","none");
	}
	else
	{
		$(".manual_div").css("display","none");
		$(".auto_div").css("display","block");
	}
});

</script>


			<!-- Add Modal -->
			<div class="modal fade" id="badge_edit" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" id="updateForm" name="updateForm">
							    <input type="hidden" id="hiddenid" name="hiddenid"/>
								<div class="row form-row">
									<div class="col-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Full Name</label>
											<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" required="">
										</div>
									</div>
									<div class="col-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" id="emailid" name="emailid" placeholder="Enter Email ID" required="">
										</div>
									</div>
									<div class="col-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Mobile Number</label>
											<input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Enter Mobile No." required="">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Registration Category</label>
											<select class="form-control" id="category" name="category" required="">
												<option value="" disabled="" selected="">--Select--</option>
    											<option value="Faculty">Faculty</option>
    											<option value="Post Graduate">Post Graduate</option>
    											<option value="Delegate">Delegate</option>
    											<option value="Accompanying Person">Accompanying Person</option>
    											<option value="Exhibitor">Exhibitor</option>
    											<option value="Support Staff">Support Staff</option>
    											<option value="Event Crew">Event Crew</option>
    											<option value="Conference Manager">Conference Manager</option>
    											<option value="Media">Media</option>
    											<option value="Organizing  Committee">Organizing  Committee</option>
    										</select>
										</div>
									</div>
									<div class="col-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label>Place</label>
											<input type="text" class="form-control" id="place" name="place" placeholder="Please Enter your place">
										</div>
									</div>										
									<div class="col-12 col-md-6 col-lg-6">
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
										<input type="checkbox" class="largerCheckbox" name="check[]" id="<?php echo $res['type_name'];?>" value="<?php echo $res['type_name'];?>">
										<label for="tall-1" style="position: relative;bottom: 5px;"><?php echo $res['type'];?></label>
									</div>
								</div>
								        <?php
								    }
								    
								}
								?>								
													
								</div>
								<input type="submit" class="btn btn-primary btn-block" value="Update" id="btnSubmit" name="btnSubmit">
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /ADD Modal -->
			
			<!-- Add Modal -->
			<!--<div class="modal fade" id="badge" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Preview</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<section class="">
									<div class="container">	
									   <div class="row">	
											<div class="col-lg-12">
												<div class="profile-widget" style="padding:0px; font-size: 15px;" >
													<div>
														<img class="img-fluid" alt="Badge" src="http://virtualcme.live/onsite_registration/badgetop.jpg">
													</div>
													
													<div class="pro-content qr-content" style="text-align: center;">
													</div>
												
												</div>
											</div>
									   </div>
									</div>
								</section>
							</form>
						</div>
						<div class="pro-footer">
							<a href="javascript:void(0);" id="btnPrint">
							    <ul class="policy-menu text-center">
									<li>Print</li>
								</ul>
							</a>
						</div>
					</div>
				</div>
			</div>-->
			<!-- /ADD Modal -->
			
			<script language='VBScript'>
Sub Print()
       OLECMDID_PRINT = 6
       OLECMDEXECOPT_DONTPROMPTUSER = 2
       OLECMDEXECOPT_PROMPTUSER = 1
       call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)
End Sub
document.write "<object ID='WB' WIDTH=0 HEIGHT=0 CLASSID='CLSID:8856F961-340A-11D0-A96B-00C04FD705A2'></object>"
</script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
<!-- scanner script -->
<script>
const video = document.createElement('video');
const canvasElement = document.getElementById('canvas');
const canvas = canvasElement.getContext('2d');
let scanning = false;

navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
    .then(function (stream) {
        video.srcObject = stream;
        video.setAttribute('playsinline', true); // required to tell iOS safari we don't want fullscreen
        video.play();
        requestAnimationFrame(tick);
    });

function tick() {
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvasElement.hidden = false;
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "dontInvert",
        });
        if (code) {
            console.log('QR Code detected: ', code.data);
            handleQRCode(code.data);
        }
    }
    if (!scanning) {
        requestAnimationFrame(tick);
    }
}

function handleQRCode(data) {
	alert(data);
    // Do something with the QR code data, such as submitting it to a server via AJAX
}
</script>
<!-- scanner script -->