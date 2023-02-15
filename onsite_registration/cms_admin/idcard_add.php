<?php include_once('top_link.php'); ?>

<?php
if (isset($_POST['id_save'])) {
    if (!file_exists('../media/')) {
        mkdir('../media/');
    }
    $upload_image = "";
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    $file_extension = pathinfo($_FILES["upload_image"]["name"], PATHINFO_EXTENSION);

    
    if (!in_array($file_extension, $allowed_image_extension)) {
        $_SESSION['errorMsg'] = "Upload valid images. Only PNG and JPEG are allowed.";
        echo '<script>location.href="idcard_add.php";</script>';
        exit();
    }

    if (!empty($_FILES['upload_image']['name'])) {
        $file_name = md5(rand(12545, 99999)) . $file_extension;
        $file_size = $_FILES['upload_image']['size'];
        $file_tmp = $_FILES['upload_image']['tmp_name'];
        $file_type = $_FILES['upload_image']['type'];
        move_uploaded_file($file_tmp, "../media/" . $file_name);
        $upload_image = "media/" . $file_name;
    }
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    if(empty($category)){
        $_SESSION['errorMsg'] = "Category is required";
        echo '<script>location.href="idcard_add.php";</script>';
        exit();
    }

    $sqry = mysqli_query($connect, "select id from icard_image where category = '$category'");
    if (mysqli_num_rows($sqry) > 0) {
        $sql = "UPDATE icard_image SET image='$upload_image' WHERE category='$category'";
        if (mysqli_query($connect, $sql)) {
            $_SESSION['successMsg'] = "Image Is Updated.";
        } else {
            $_SESSION['errorMsg'] = "something went wrong please try again....";
        }
        echo '<script>location.href="idcard_add.php";</script>';
        exit();
    }else{
        $sql = "INSERT into icard_image set  image='$upload_image',category='$category'";
        if (mysqli_query($connect, $sql)) {
            $_SESSION['successMsg'] = "Image Is Added.";
        } else {
            $_SESSION['errorMsg'] = "something went wrong please try again....";
        }
        echo '<script>location.href="idcard_add.php";</script>';
        exit();
    }
}
?>

<!-- START CONTENT -->
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">New ID-card Image</h1>
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li class="active">
                            <strong>New ID-card Image</strong>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">

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
                                <form method="POST" enctype="multipart/form-data">

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fullname">Category</label>
                                            <span class="desc">e.g. "Faculty"</span>
                                            <div class="controls">
                                                <select class="form-control" id="category" name="category" required="">
                                                    <option value="" disabled="" selected="">--Select--</option>
                                                    <option value="Delegate">Delegate</option>
                                                    <option value="Spouse">Spouse</option>
                                                    <option value="Conference Manager">Conference Manager</option>
                                                    <option value="Organizing  Committee">Organizing Committee</option>
                                                    <option value="Faculty">Faculty</option>
                                                    <option value="Conference Crew">Conference Crew</option>
                                                    <option value="Accompanying Person">Accompanying Person</option>
                                                    <option value="Exhibitor">Exhibitor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label" for="field-1">Upload Image</label>
                                            <div class="controls">
                                                <input type="file" class="form-control" id="upload_image" name="upload_image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-success" name="id_save">Save</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

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