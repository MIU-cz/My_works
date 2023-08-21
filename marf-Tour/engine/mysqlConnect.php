<?php
// 'localhost', 'admin', 'admin', 'marf-travel'
//  $host, $name, $pass, $db
// include "./engine/mysqlConnect.php";
// endora-db-01.stable.cz, marfadmin, 3NRU2SWgh5t@6qa, marf2082023
$host = 'localhost';
$name = 'admin';
$pass = 'admin';
$db = 'marf-travel';


// ===============================================================
// $mysql = new mysqli('localhost', 'admin', 'admin', 'marf-travel');
// $mysql->query("SET NAMES 'utf8'");
// if ($mysql->connect_error) {
// 	header("Location: index.php?page=nocontent");
// 	exit();
// }

// session_start();
// try {
// $mysql = new mysqli('localhost', 'admin', 'admin', 'marf-travel');
// if ($mysql->connect_error) {
// header("Location: index.php?page=nocontent ");
// exit();
// } else {
// if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
// header("Location: index.php?page=adminka");
// } else {
// header("Location: index.php?page=main");
// }
// exit();
// }
// } catch (mysqli_sql_exception $e) {
// header("Location: index.php?page=nocontent ");
// exit();
