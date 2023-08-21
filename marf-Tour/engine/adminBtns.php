<?php
$btn = $_GET['btn'];
$id = $_GET['id'];

include "mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);
// $tabRooms = $mysql->query("SELECT * FROM `Rooms` WHERE `id` LIKE '$id'");

$copy = "INSERT INTO `Rooms` (photo1, photo2, photo3, photo4, name, description, room) 
	SELECT photo1, photo2, photo3, photo4, name, description, room FROM `Rooms` WHERE id=$id";

$dell = "DELETE FROM `Rooms` WHERE id=$id";

if ($btn == 'copy') {
	$query = $copy;
} elseif ($btn == 'dell') {
	$query = $dell;
}
// elseif ($query == 'bookings') {}
else {
	exit();
}
echo $query;
$mysql->query($query);
header('Location: ../../adminka.php');
$mysql->close();
