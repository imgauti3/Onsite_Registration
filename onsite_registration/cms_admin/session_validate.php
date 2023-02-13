<?php
@session_start();
if (empty($_SESSION['username']) && empty($_SESSION['userid'])) {
    echo '<script>location.href="index.php";</script>';
    exit();
}
?>