<?php
include '../conn.php';
$dni = $_POST['value'];
$mysqli  = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit;
}
if(!is_null($dni)&&$dni!=''){
  $sql = 'SELECT * FROM clients WHERE dni = "'.$dni.'"';
  if (!$result = $mysqli->query($sql)) {
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
  }
  if ($result->num_rows === 0) {
    return 0;
  } else {
    $record = $result->fetch_assoc();
    echo json_encode($record);
  }
} else {
  return 0;
}
$result->free();
$mysqli->close();
?>
