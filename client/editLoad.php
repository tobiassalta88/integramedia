<?php
session_start();
include '../conn.php';

$mysqli  = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit;
}

$id = $_POST['id'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$dni = $_POST['dni'];
$birthday = $_POST['birthday'];
$credit_card = $_POST['credit_card'];

$sql = "UPDATE clients SET name='".$name."', last_name='".$last_name."', birthday='".$birthday."', credit_card='".$credit_card."' WHERE id=".$id;

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Changes were saved successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
