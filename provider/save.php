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
$direction = $_POST['direction'];
$phone = $_POST['phone'];

$sql = "INSERT INTO providers (name, direction, phone) VALUES ('$name', '$direction', '$phone')";

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Congratulations, new record created successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
