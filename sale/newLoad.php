<?php
session_start();
include '../conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

$id_client = $_GET['c'];
$total = $_SESSION['total'];
$id_employee = $_SESSION['id'];

$query = "INSERT INTO sales (id_client, id_employee, total) VALUES ('$id_client', '$id_employee', '$total')";
$result = mysqli_query($conn, $query) or die('Error: ' . mysql_error());
$last_id = mysqli_insert_id($conn);

foreach (@$_SESSION['tTemp'] as $key){
  $a = explode("|||",@$key);
  $query = "INSERT INTO sales_detail (id_sale, id_product, quantity, price, amount) VALUES ('$last_id', '$a[0]', '$a[2]', '$a[3]', '$a[4]')";
  $result = mysqli_query($conn, $query) or die('Consulta fallida: ' . mysql_error());
}

echo $last_id;
