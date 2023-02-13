<?php

include_once("../config.php");
$result=mysqli_query($conn,"insert into print_setup values('".$_POST["metric"]."',".$_POST["top"].",".$_POST["bottom"].",".$_POST["font"].",'".$_POST["paper_size"]."')");
echo $result;



?>