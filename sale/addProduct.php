<?php
session_start();
$prod = $_POST['prod'];
$_SESSION['tTemp'][] = $prod;
 ?>
