<?php
include_once('../config.php');
$uid = $_POST['uid'];
$conditions = array("where" => array('unique_id' => $uid));
$record = $db->getRows('delegate_list', $conditions);

$phone = $record[0]['mobileno'];
$fullName = $record[0]['fullname'];
$email = $record[0]['emailid'];
$reg_category = $record[0]['reg_category'];

$sqry = mysqli_query($connect, "select * from icard_image where category = '$reg_category'");
$row = mysqli_fetch_row($sqry);
$image = "./assets/img/delegate.jpg";
if (isset($row[1])) {
    $image = $base_url . $row[1];
}
?>
<html>

<head>

<style>
    @media (max-width:400px){
        .scn-name{
            font-size: 13px !important;
        }
        .scn-image{
            width: 90px !important;
        }
        .scn-wrap{
            bottom: 110px !important;
        }
    }
</style>

</head>

<body>
    <div style="position: relative;">
        <img src="<?php echo $image; ?>" alt="">
        <div style="position: absolute;bottom: 140px;left: 0;right: 0;" class="scn-wrap">
            <?php
            echo "<h3 class='scn-name' style='font-size:20px !important; color:#000; text-align: center;'><b>" . wordwrap(ucWords(strtoupper($record[0]['fullname'])), 25, "<br >", false) . "</b></h3>";
            ?>
            <img src="<?php echo $base_url; ?>qrcode/generate_QR.php?uid=<?php echo $uid; ?>" style="display: block; width: 150px; margin: auto;" class="scn-image" />
        </div>

        <button class="btn btn-success print" style="margin:10px;" data-id="<?php echo $uid; ?>">Print</button>
    </div>
</body>

</html>