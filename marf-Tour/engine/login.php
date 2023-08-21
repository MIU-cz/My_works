<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include "mysqlConnect.php";
	$linkdb = new mysqli($host, $name, $pass, $db);

	$pass = htmlspecialchars($_POST['userPass']);
	$mail = $_SESSION['mail'];

	$query = "SELECT * FROM `Users` WHERE email='$mail'";
	$userData = $linkdb->query($query);
	$user = $userData->fetch_assoc();

	if ($user['password'] == $pass) {
		echo 'its ok!';
		$_SESSION['errors'] = false;
		$_SESSION['errmsg'] = '';
		$_SESSION['userName'] = $user['username'];
		$_SESSION['mail'] = $mail;
		$_SESSION['userRole'] = $user['role'];
		$_SESSION['userId'] = $user['id'];

		if ($user['role'] == 'admin') {
			header('Location: ../adminka.php');
		} else {
			header('Location: ../');
		}
	} else {
		$_SESSION['errors'] = true;
		$_SESSION['errmsg'] = 'wrong pass !!';
		$_SESSION['mail'] = $mail;
		$_SESSION['userName'] = $user['username'];
		header('Location: ../?page=authChek');
	}

	$linkdb->close();
	exit();
}
