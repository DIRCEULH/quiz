
<?php
if($_SESSION['login']='ok'){
    session_start();
    session_destroy();
    header("location: index.php");
    exit();
}
?>