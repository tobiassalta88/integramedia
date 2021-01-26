<?php
session_start();
$index=$_POST['i'];
unset($_SESSION['tTemp'][$index]);
$data=array_values($_SESSION['tTemp']);
unset($_SESSION['tTemp']);
$_SESSION['tTemp']=$data;
?>
