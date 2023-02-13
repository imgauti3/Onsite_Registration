<?php

require "../barcode/vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorPNG();
//$path=$_SERVER['DOCUMENT_ROOT']."/onsite_badge_printing/config.php";

$path="../config.php";
include_once($path);

	parse_str($_POST['data'], $arr); //unserialize the post data
//$db = new DB();
//$uid=base64_decode($_POST['UID']);
//$conditions=array("where"=>array('uid'=>$uid));
//$record=$db->getRows('registered_list',$conditions);

//Qr code generation
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeNumber= "0123456789";
        $max = strlen($codeAlphabet);
    
       for ($i=0; $i < 4; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, 26-1)];
        }
    
    for ($i=0; $i < 4; $i++) {
            $token .= $codeNumber[crypto_rand_secure(0, 10-1)];
        }
    
    $uid=$token;
	
$d['html'] ='<img src="'.$base_url.'qrcode/generate_QR.php?uid='.$uid.'" width="24%" height="24%"/>';  
$d['html'] .="
                    <span class='font' style='line-height:1;color:#000;'><b>".wordwrap(ucWords(strtoupper($arr['fullname'])), 24, "<br >",false)."</b></span>
                    <span class='font' style='margin-top:10px;color:#000;'>".ucWords($arr['city'])."</span>
                   <img width='35%' src='data:image/png;base64," . base64_encode($Bar->getBarcode($uid, $Bar::TYPE_CODE_128_A)) . "'>
                    <h6 style='color:#000;'>".$uid."</h6>
    ";
$d['uid']=$uid;

echo json_encode($d);


?>