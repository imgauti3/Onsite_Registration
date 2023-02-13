<?php
include_once('../config.php');
include_once('qrcode/libs/phpqrcode/qrlib.php');

//approved delegate send email
if (isset($_POST['regId']) && !empty($_POST['regId']) && $_POST['sendMail_del'] == 1) {
    $regid = $_POST['regId'];
    //echo $regid;exit;
    $sqry = mysqli_query($connect, "select * from delegate_list where id='$regid'");
    if (mysqli_num_rows($sqry) > 0) {
        $results = mysqli_fetch_assoc($sqry);
        $unique_id = $results['unique_id'];
        $fullname = $results['fullname'];
        $email = $results['emailid'];
        $mobile = $results['mobileno'];
        $category = $results['reg_category'];
        $place = $results['place'];
      
      
      $tempDir2 = 'qrcode/agreement-pdf/qrimages/'; 
	$qrimage2 = md5(rand(12545,99999)).str_replace(' ', '_', $unique_id);
	$codeContents2 = $unique_id; 
// 	$codeContents2 = "Your Registration ID:".$uid; 
	QRcode::png($codeContents2, $tempDir2.''.$qrimage2.'.png', QR_ECLEVEL_L, 5);
	$qrimagepath2=$base_url."cms_admin/qrcode/agreement-pdf/qrimages/".$qrimage2.".png";
	
	$html="<p><b>Dear $fullname</b>,<br><br>
Thank you for your registration to the ILTS-iLDLT-LTSI Consensus Conference & MCLD 2023 to be held in Chennai, Tamil Nadu, India, January 27-29, 2023.<br>
To prepare for the Congress, please find below the opening hours, venue, and further practical information here: <br> <br>
<b>Travel regulations: </b><br>
Make sure to be informed about the travel restrictions to India from your country: <br> <br>
<b>Venue: </b><br>
Hotel - ITC Grand Chola, Chennai <br>
63, Anna Salai, Little Mount, Guindy, Chennai, Tamil Nadu 600032.<br><br>
<b>Your registration no :</b> $unique_id<br><br>
Please scan your QR code to get the badge printed.<br>
<img src='$qrimagepath2'><br>
<b>Self-Registration Kiosk</b><br>
On January 26, you may print your name at the Self-Registration Kiosks using the attached registration confirmation with QR code. There will be a Self-Registration Kiosk in the hotel check-in area on the ground floor and one at level 2 next to Kaveri Hall. Alternatively, you may obtain your name badge at the registration counter, please see below: 
<br><br><b>Registration Counter </b><br>
Location: From the main entrance - Chola Porch please use the escalator to reach level 1. <br> 	
Opening hours:<br>
Friday, January 27 (07:00 - 17:30)<br>
Saturday, January 28 (07:00 - 17:30)<br><br>
<b>Program</b><br>
The detailed Program can be found <a href='https://www.relainstitute.com/MCLD2023/pdf/Programme.pdf'>here<a><br><br>
The <b>Exhibition</b> is located in the Pre-Function Area at level 1 and level 2<br>
Opening hours: 	<br>
Friday, January 27 (08:00 – 18:00)	<br>	
Saturday, January 28 (08:00 – 18:00)<br>
Sunday, January 29 (08:00 – 18:00)<br><br>
<b>Conference Meals will be served as follow:</b><br>
Friday, January 27 (Rajendra Hall – 7 & 8) (13:15 – 14:15)<br>	
Saturday, January 28 (Rajendra Hall – 7 & 8) (12:35 – 13:35)<br>
Sunday, January 29 (Rajendra Hall) (12:35 – 14:00)<br>
Coffee breaks will be served during the three days in the Pre-Function Area at level 2 <br>
<b>Social Events:<br>
Entry to the social events will only be permitted by showing your name badge, please remember to bring it with you!</b><br><br>
Friday, January 27 (19:00 - <b>Presidential Dinner</b> at Rajendra Hall)<br>
Saturday, January 28 (19:00 - <b>MCLD Gala Dinner</b> at Rajendra Hall)<br><br>
The Dress code for both events is smart-casual.<br><br>
For any questions, please do not hesitate to get in touch with us suing the contact details listed below:<br>
Ilts2023consensus@relainstitute.com <br>
<b>For Registration & Exhibition:</b> Mr. Vikram Pola - +91-9014666161<br>
<b>For Transport Management:</b> Mr. Gaurav Singh - +91 74886 58371<br>
<b>For Escalations:</b> Mr. Tarun Mahajan: +91-9971718136 <br><br>
We look forward to welcoming you to Chennai!<br><br>
<b>Sincerely,<br>
Conference Secretariat<br>
ILTS-iLDLT-LTSI Consensus Conference & MCLD 2023</b><br>
https://www.relainstitute.com/MCLD2023/index.html";  
	
// 	$html="<img src='$qrimagepath2'><p><b style='text-align:center;font-size:25px;'>$fullname</b><br>$place</p>";
	
	   // $html="<p style='text-align:center;font-size:25px;'><b>Registration Acknowledgement</b></p>
	   // <strong>Dear $fullname</strong>, <br>
    //   <br>Thank you for registering for <span class='il'><b>$event_name</b></span>, scheduled to be held from <b>$event_date</b>.
    //   <br><br>
    //   <b>Please find your registration details as mentioned below:</b><br>
    //   <b> <img src='$qrimagepath2'><br>
    //   <b>Registration ID</b> - $unique_id<br>
    //   <b>Full Name</b> - $fullname<br>
    //   <b>Email ID</b> - $email<br>
    //   <b>Mobile No</b> - $mobile<br>
    //   <b>Category</b> - $category<br>";

        $subject="MCLD 2023 Registration - eBadge";
        $db->sendMail($subject,$html, $email, $fullname, $mail_header1,$mail_footer2, $event_name);
        // $db->sendMail($subject,$html, $email, $fullname, $mail_header,$mail_footer, $event_name);
        echo 'Email has been sent to '.$email;
    } else {
        echo 'Something went wrong. Please try again';
    }
}

?>