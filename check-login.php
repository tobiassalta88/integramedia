<?php
session_start();
include 'conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$dni = $_POST['dni'];
$result = mysqli_query($conn, "SELECT id, name, dni, file FROM employees WHERE dni = '$dni'") or die('Consulta fallida: ' . mysql_error());
$row = mysqli_fetch_assoc($result);
if ($_POST['pass']==$row['file']) {
	$_SESSION['loggedin'] = true;
	$_SESSION['id'] = $row['id'];
	$_SESSION['name'] = $row['name'];
	header('Location: index.php');
} else {
	header('Location: login.html');
}
?>
