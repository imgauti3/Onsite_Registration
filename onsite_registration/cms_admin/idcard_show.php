<?php include_once('top_link.php'); ?>
<?php

// $sqry = mysqli_query($connect, "select * from icard_image");
$query = "select * from icard_image";
$result = mysqli_query($connect, $query);
?>

<!-- START CONTENT -->
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">ID-Card Images</h1>
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li class="active">
                            <strong>ID-Card Images</strong>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box ">
                <div class="content-body">
                    <div class="row">

                        <?php if (isset($_SESSION['successMsg'])) { ?>
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'];
                                                                unset($_SESSION['successMsg']); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['errorMsg'])) { ?>
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-dismissible" style="margin-top:18px;">
                                    <strong>Error!</strong> <?php echo $_SESSION['errorMsg'];
                                                            unset($_SESSION['errorMsg']); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- ********************************************** -->

                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 0;
                                        while ($results = mysqli_fetch_assoc($result)) {
                                            $count++;
                                    ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $results['category']; ?></td>
                                                <td><img style="width: 20%;height: 100%;" src="<?php echo $base_url . $results['image']; ?>">
                                            </tr>
                                    <?php }
                                    } else {
                                        echo 'No records found.';
                                    }
                                    ?>
                                </tbody>
                            </table>
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