<?php
session_start();
include '../conn.php';

$mysqli  = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit;
}

$name = $_POST['name'];
$last_name = $_POST['last_name'];
$dni = $_POST['dni'];
$birthday = $_POST['birthday'];
$credit_card = $_POST['credit_card'];

$sql = "INSERT INTO clients (name, last_name, dni, birthday, credit_card) VALUES ('$name', '$last_name', '$dni', '$birthday', '$credit_card')";

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Congratulations, new record created successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
