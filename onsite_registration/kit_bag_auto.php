<?php include_once('header.php'); ?>
			
			<!-- -->
			<div class="appmt-form doctors-col registratio-section">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
						<h2>Kitbag Scanning (Auto Scanning)</h2>
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
			    $(document).on("keyup","#search",function(event){
                    var searchKey = $(this).val().toLowerCase();
                    clearTimeout(timeout);
                    timeout = setTimeout(function () {
                        if(searchKey.length>3)
                        {
                            $.ajax({
                                type:"post",
                                url:"process.php",
                                data:"kitbagKey="+searchKey+"&kitbagAuto=1",
                                success:function(data){
                                    $(".customMsg").html('');
                                    $("#search").val('');
                                    var res =$.parseJSON(data);
                                  $(".regData").html(res.html);
                                  if (res.error) {
                                      $(".customMsg").html('<div class="alert alert-danger" role="alert">'+res.error+'</div>');
                                  }
                                  if (res.success) {
                                      $(".customMsg").html('<div class="alert alert-success" role="alert">'+res.success+'</div>');
                                  }
                                  
                                }
                            });
                            return false;
                        }
                    }, 500);
            });
            </script>
			