<?php
session_start();
if (!isset($_SESSION['username'])) {
   header('location: login.php');
}

require_once 'lib/db_login.php';
$id = $_GET['id'];

$query = "DELETE FROM customers WHERE customerid ='$id'";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
header("Location: view_customer.php");
?>