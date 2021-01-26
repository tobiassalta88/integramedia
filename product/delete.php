<?php
session_start();
include '../conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$index = $_POST['id'];
$query = 'DELETE FROM products WHERE id='.$index ;
$result = $conn-> query($query);
mysqli_close($conn);
// Upload message with notification
$_SESSION['message'] = "Perfect, product was successfully removed.";
?>
