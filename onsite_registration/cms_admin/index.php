<?php @session_start(); include_once('../config.php'); ?>
<!DOCTYPE html>
<html class=" ">
    <head>
        <!-- 
         * @Package: Ultra Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 4.1
         * This file is part of Ultra Admin Theme.
        -->
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title><?php echo $event_name;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->




        <!-- CORE CSS FRAMEWORK - START -->
        <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- CORE CSS TEMPLATE - START -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
        
        <style>
        .loginpage h1 a {
    height: 92px;
    margin: 0px auto 0px auto;
    padding: 0;
    text-decoration: none;
    -moz-background-size: 345px 92px;
    -o-background-size: 345px 92px;
    background-size: 345px 92px;
    background-color: transparent;
    min-height: 92px;
    width: auto;
    /*background-image: url('<?php echo $website_logo;?>') !important;*/
    background-position: center top;
    background-repeat: no-repeat;
    text-indent: -9999px;
    outline: 0;
    overflow: hidden;
    display: block;
}
</style>

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" login_page">


        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12" style="margin-top: 111px;">
                <h1><a href="#" title="Login Page" tabindex="-1">Admin Login</a></h1>

                <form name="loginform" id="loginform" method="post">
                    <p>
                        <label for="user_login" style="color:#000;">User Name<br />
                        <input type="text" name="username" id="username" class="input" size="20" required /></label>
                    </p>
                    <p>
                        <label for="user_pass" style="color:#000;">Password<br />
                        <input type="password" name="password" id="password" class="input"  size="20" required/></label>
                    </p>
                    <p class="submit">
                        <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-orange btn-block" value="Sign In" />
                    </p>
                </form>

            </div>
        </div>





        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


        <!-- CORE JS FRAMEWORK - START --> 
        
        <script src="assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.easing.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
        <!-- CORE JS FRAMEWORK - END -->


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="assets/plugins/icheck/icheck.min.js" type="text/javascript"></script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
       
        <!--<script src="assets/js/jquery.validate.js"></script>-->
        <script src="assets/js/jquery.validate.js"></script>
        <script>
        $("form[name='loginform']").validate({
            
            
            submitHandler: function (form) {
                var username = $("#username").val();
                var password = $("#password").val();
                $.ajax({
                url: "ajax.php",
                type: "POST", 
                data: 'username='+username+'&password='+password,
                cache: false,
                success: function(data) {
            			var splitData=data.split('@@@');
            			if (splitData[0]==1) {
            			    window.location.href='approved_registration.php';
            			}
            			if (splitData[0]==0)
            			{
            			    $("#displayError").html('<div class="alert alert-warning"><strong>Error! </strong>'+splitData[1]+'</div>');
            			}
            			$('#loginForm')[0].reset();
                    }
                });
            }
         
        });
        </script>

    </body>
</html>



