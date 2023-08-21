<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include "mysqlConnect.php";
	$linkdb = new mysqli($host, $name, $pass, $db);

	$name = htmlspecialchars($_POST['userName']);
	$pass = htmlspecialchars($_POST['userPass']);
	$mail = $_SESSION['mail'];

	$query = "INSERT INTO `Users` (username, email, password, role) 
	VALUES ('$name', '$mail', '$pass', 'user')";

	if ($linkdb->query($query)) {
		echo 'its ok!';
		$_SESSION['errors'] = false;
		$_SESSION['mail'] = $mail;
		header('Location: ../?page=authChek');
	}

	$linkdb->close();
	exit();
}
