<?php

require "../barcode/vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorPNG();
$path="../config.php";
include_once($path);


$db = new DB();
$uid=base64_decode($_POST['UID']);
$conditions=array("where"=>array('uid'=>$uid));
$record=$db->getRows('registered_list',$conditions);

$phone=$record[0]['mobile'];
$fullName=$record[0]['name'];
$email=$record[0]['email'];




//Qr code generation
if($_POST['img_type']!='Both')
{
if($_POST['img_type']=='qr')
{

    echo '<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="30%" height="30%"/>';
}
else {
   $path=$base_url.$record[0]['profile'];
       echo '<img src="'.$path.'" width="30%" height="30%"/>';
 
}
}
else
{
    $path=$base_url.$record[0]['profile'];
       echo '<img src="'.$path.'" width="120px" height="120px" />';
       //echo '<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="24%" height="24%"/>';
}


echo "
<span class='font' style='line-height:1;color:#000;'><b>".wordwrap(ucWords(strtoupper($record[0]['name'])), 24, "<br >",false)."</b></span>
                    <span class='font' style='margin-top:10px;color:#000;'>".ucWords($record[0]['city'])."</span><br>
                    <img width='50%' src='data:image/png;base64," . base64_encode($Bar->getBarcode($uid, $Bar::TYPE_CODE_128_A)) . "'>
                    <h6>".$record[0]['uid']."</h6>";
  
    if($_POST['img_type']=='Both')
{
    echo '<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="24%" height="24%"/>';
}


?>
