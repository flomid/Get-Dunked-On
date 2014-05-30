<?php session_start();
session_destroy();
setcookie(session_name(), session_id(), time()-10000, "/");
header("location:signin.php")
?>