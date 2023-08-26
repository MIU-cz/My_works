<?php
session_start();
require "./components/autoloadComponent.php";

$pageDir = './components/pages/';
$langDir = './components/lang/';

if (isset($_GET['page'])) {
	$page = $_GET['page'];
	if (!file_exists($pageDir . $page . '.php')) {
		$page = 'nocontent';
	}
} elseif (isset($_SESSION['page'])) {
	$page = $_SESSION['page'];
} else {
	$page = 'homepage';
}

if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if (!file_exists($langDir . $page . '-' . $lang . '.php')) {
		$lang = 'cz';
	}
} elseif (isset($_SESSION['lang'])) {
	$lang = $_SESSION['lang'];
} else {
	$lang = 'cz';
}

$content = $pageDir . $page . '.php';
$_SESSION['lang'] = $lang;
$_SESSION['page'] = $page;
include($langDir . $page . '-' . $lang . '.php');
?>

<!DOCTYPE html>
<html lang=<?php echo $lang ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page; ?> | MARF | VVM-IPSO-v2</title>
	<meta name="description" content="testova uloha MARF:Mykhailenko">
	<link rel="shortcut icon" href="./src/ico/ico-marf-bg.png" type="image/png">
	<link rel="stylesheet" href="./components/autor-resourse/my-normaliz-style-min.css">
	<link rel="stylesheet" href="./src/css/main.css">
	<link rel="stylesheet" href="./src/css/<?php echo $page; ?>.css">
</head>

<body>
	<header class="container_wraper">
		<?php echo Header::render(); ?>
	</header>


	<main class="container_wraper">
		<div class="main_container">
			<div class="container_content">
				<?php include($content); ?>
			</div>
		</div>
	</main>


	<footer class="container_wraper">
		<?php echo Footer::render(); ?>
	</footer>

</body>

</html>