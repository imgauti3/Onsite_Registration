<?php
include "../qrcode/qrlib.php";
QRcode::png($_GET['uid']);
?>
