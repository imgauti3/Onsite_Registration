<?php include_once('header.php'); ?>
			
			<!-- -->
			<div class="appmt-form doctors-col registratio-section">
				<div class="container">
				<div class="row justify-content-center">
					<div class="doctors-title text-center">
						<h2>Food Scanning List (Manual Scanning)</h2>
					</div>
				</div>
					<div class="row justify-content-center">
						<div class="col-12 col-lg-12">
							
							<div class="row">
							    <?php
							    $sqry = mysqli_query($connect, "select * from food_scanning where 1=1");
							    if (mysqli_num_rows($sqry) > 0) {
							        while($res = mysqli_fetch_assoc($sqry)) {
							            $scanning_type_name = $res['scanning_type_name'];
							            $scanning_date = $res['scanning_date'];
							            $getTotalCount = $db->getFieldCount('delegate_list',$res['scanning_type_name'], '');
							            $getTakenCount = $db->getFieldCount('delegate_list',$res['scanning_type_name'], 1);
							         //   $getNotallowCount = $db->getFieldCount('delegate_list',$res['scanning_type_name'], 0);
							            $finalTotal = $getTotalCount+$getTakenCount;
							            ?>
        							    <div class="col-12 col-md-3">
        									<a id="foodModal" data-toggle="modal" data-normal="food_scanning.php?token=<?php echo $scanning_type_name;?>&date=<?php echo $scanning_date;?>" data-auto="food_scanning_auto.php?token=<?php echo $scanning_type_name;?>&date=<?php echo $scanning_date;?>" href="#foodscanning"><div class="count-box text-center">
        										<h3><?php echo $getTakenCount.'/'.$finalTotal;?></h3>
        										<p class="mb-0"><?php echo $res['scanning_type'];?></p>
        									</div></a>
        								</div>
							            <?php
							        }
							    }
							    ?>
						
							</div>
						</div>
					</div>
				</div>				
			</div>
			<!-- / -->

			<?php include_once('footer.php'); ?>
			<script>
			    $(document).on("click", "#foodModal", function(){
			        var auto = $(this).data('auto');
			        var normal = $(this).data('normal');
			        $(".f-manual").attr('href', normal);
			        $(".f-auto").attr('href', auto);
			    })
			</script>
			