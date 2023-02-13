<?php include_once('header.php'); ?>
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
        .certificateName{
           /*font-size:24px;font-family:italianregular;word-spacing: 10px;*/
           font-size:24px;font-family:italic;word-spacing: 10px;
        }
    }
</style>

			<!-- -->
			<div class="appmt-form doctors-col registratio-section">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
						<h2>Certificate Printing</h2>
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
						   
							<div class="row">
								<div class="col-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label>Please enter registerd participated details </label>
										<input type="text" class="form-control" id="search" name="search" placeholder="Search...." required="">
									</div>
								</div>
								
								<div class="col-12 col-md-12 col-lg-1">
									<div class="form-group">
										<label>Mode </label>
										<select class="form-control" id="mode" name="mode" required="">
											<option value="" disabled="" selected="">--Select--</option>
											<option value="Manual">Manual</option>
											<option value="Auto">Auto</option>
    									</select>
									</div>
								</div>
								
							</div>
							
					<div class="row datarowcls" style="display:none">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>Actions</th>
													<th>Unique ID</th>
													<th>Category</th>
													<th>Full Name</th>
													<th>Email ID</th>
													<th>Mobile No.</th>
												</tr>
											</thead>
											<tbody class="regData">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>			
					</div>
				
				
						</div>
					</div>
				</div>				
			</div>
			<!-- / -->
			

			<?php include_once('footer.php'); ?>
			
			<?php
			
      $print=$db->getRows('certificate_print_setup',array());
    
    echo "<div class='container printdata' >
            <div class='row' id='badge'>
			    <div class='col-md-6 template' style='
            transform: ";
            if($print[0]["orientation"]== 'landscape'){
            echo 'rotate(90deg)';
            } else {
            echo 'rotate(0deg)';
            }
            echo "'>
                <div class='top' style='margin-top:".($print[0]["top"]-1).$print[0]["metric"].";'>

                </div>
                <div class='qr-content' style='margin-left:".$print[0]["indent_left"].$print[0]["metric"]."; text-align:center;'>
                </div>
                <div class='bottom' style='margin-top:".$print[0]["bottom"].$print[0]["metric"].";'>

                </div>
                </div>
            </div>
            </div>";
    ?>
			
			
			
			<script>
			    $(document).on("keyup","input[name='search']",function(){
                    var searchKey = $(this).val().toLowerCase();
                    var searchMode = $("#mode").val();//Auto  Manual
                    setTimeout(function () {
                        if(searchKey.length>3)
                        {
                            $.ajax({
                                type:"post",
                                url:"process.php",
                                data:"searchKey="+searchKey+"&certsearch=1"+"&searchMode="+searchMode,
                                success:function(data){
                                  $(".regData").html(data);
                                  if(searchMode=='Auto'){
                                  setTimeout(function(){
                                      $(".print").trigger("click");
                                      $("#mode").val('');
                                   },1000);
                                  }
                                  else
                                  {
                                      $(".datarowcls").css('display','block');
                                  }
                                }
                            });
                        }
                    }, 500);
            });
            
            
            $(document).on("click",".print",function(){
                var delid = $(this).data("id");
                $("#hiddenid").val(delid);
                
                var delName = $(this).data("name");
            $(".printdata").toggleClass("hide");
            $(".qr-content").html("<b class='certificateName' style='font-size:24px;word-spacing: 10px;'>"+delName+"</b>");
            setTimeout(function(){
                            window.print();
                            $(".printdata").toggleClass("hide");
                        },1000);
                
            });
           /* $(document).on("click",".print",function(){
                var delid = $(this).data("id");
                $("#hiddenid").val(delid);
                $.ajax({
                    type:"post",
                    url:"barcode/generate.php",
                    data:{uid:$(this).data("id"),img_type:'<?=$print[0]["img_type"]; ?>'},
                    success:function(data){
                       // $(".printdata").toggleClass("hide");
                        $(".qr-content").html(data);
                        
                        setTimeout(function(){
                            window.print();
                            $(".printdata").toggleClass("hide");
                        },1000);
                        
                    }
                });
            });*/
            
var media = window.matchMedia('print');
media.addListener(function(mql) {
    if (!mql.matches) {
        if (confirm("Have you Printed Certificate?")) {
            var delid = $("#hiddenid").val();
            $.ajax({
                type:"post",
                url:"process.php",
                data:{uid:delid,certprint:true},
                // data:{uid:delid,print:true},
                success:function(data){
                  if(data)
                  {
                      //remove search tag value and search mode
                      $("#search").val('');
                      $("a[data-id='"+delid+"']").removeClass("btn-success").addClass("btn-danger").text("Printed");
                      ajaxCall();
                  }
                }

            });
        }
        else
        {
             //remove search tag value and search mode
                      $("#search").val('');
        }
    }
});


$(document).ready(function(){
    ajaxCall();
})

setInterval(ajaxCall, 60000); //300000 MS == 5 minutes
function ajaxCall() {
    $.ajax({
        type:"post",
        url:"process.php",
        data:"getData=1",
        datatype:'json',
        success:function(data){
            var parsed=$.parseJSON(data);
            $("#totalRegistartions").html(parsed.totalDel);
            $("#badgesPrinted").html(parsed.badgePrinted);
            $("#kitbagDelivered").html(parsed.kitbagDelivered);
        }
    });
}


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
												<option value="Delegate">Delegate</option>
												<option value="Spouse">Spouse</option>
												<option value="Conference Manager">Conference Manager</option>
												<option value="Organizing  Committee">Organizing  Committee</option>
												<option value="Faculty">Faculty</option>
												<option value="Conference Crew">Conference Crew</option>
												<option value="Accompanying Person">Accompanying Person</option>
												<option value="Exhibitor">Exhibitor</option>
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