<?php
session_start();
include '../conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$index = $_POST['id'];
$query = 'DELETE FROM clients WHERE id='.$index ;
$result = $conn-> query($query);
mysqli_close($conn);
// Upload message with notification
$_SESSION['message'] = "Perfect, customer was successfully removed.";
?>
