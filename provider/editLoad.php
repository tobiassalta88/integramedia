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
$direction = $_POST['direction'];
$phone = $_POST['phone'];

$sql = "UPDATE providers SET name='".$name."', direction='".$direction."', phone='".$phone."' WHERE id=".$id;

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Changes were saved successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
