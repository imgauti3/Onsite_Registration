<?php include_once('header.php'); ?>
<?php
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $date = $_GET['date'];
} else {
    $_SESSION['errorMsg'] = 'Something went wrong. Please try again later.';
    echo "<script>location.href='index.php';</script>";
    exit();
}
?>
			<!-- -->
			<div class="appmt-form doctors-col registratio-section">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
						<h2>Food Scanning (<?php echo $date;?> - Auto)</h2>
					</div>
				</div>
					<div class="row justify-content-center">
						<div class="col-12 col-lg-12">
							<div class="row">
							    <div class="customMsg"></div>
								<div class="col-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label>Please enter registerd participated details </label>
										<input type="text" class="form-control" id="search" name="search" placeholder="Search...." required="">
									</div>
								</div>
							</div>
							
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>Actions</th>
													<th>Unique ID</th>
													<th>Full Name</th>
													<th>Category</th>
													<th>Email ID</th>
													<th>Place</th>
													<th>Email ID</th>
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
			<script>
			var timeout = null;
			    $(document).on("keyup","input[name='search']",function(){
                    var searchKey = $(this).val().toLowerCase();
                    var token = "<?php echo $token;?>";
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        if(searchKey.length>3)
                        {
                            $.ajax({
                                type:"post",
                                url:"process.php",
                                data:"foodKey="+searchKey+"&foodAuto=1&foodtoken="+token,
                                success:function(data){
                                    $("#search").val('');
                                    var res =$.parseJSON(data);
                                    $(".regData").html(res.html);
                                    $(".customMsg").html('');
                                    if (res.error) {
                                      $(".customMsg").html('<div class="alert alert-danger" role="alert">'+res.error+'</div>');
                                  }
                                  if (res.success) {
                                      $(".customMsg").html('<div class="alert alert-success" role="alert">'+res.success+'</div>');
                                  }
                                }
                            });
                        }
                    }, 500);
                });
			</script>
			