<?php
require_once('./lib/db_login.php');

$name = $db->real_escape_string($_GET['name']);
$address = $db->real_escape_string($_GET['address']);
$city = $db->real_escape_string($_GET['city']);

// Assign a query
$query = "INSERT INTO customers (name, address, city) VALUES ('" . $name . "', '" . $address . "', '" . $city . "')";
$result = $db->query($query);

if (!$result) {
    // TODO 1: Jika error, tulislah response yang sesuai
} else {
    // TODO 2: Jika sukses, tulislah response yang sesuai
}

// Close DB Connection
$db->close();
