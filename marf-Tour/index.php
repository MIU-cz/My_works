<!DOCTYPE html>
<html lang="cs">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MARF-travel test-task</title>
	<link rel="shortcut icon" href="./src/icons/ico-marf-bg.png" type="image/png">
	<link rel="stylesheet" href="./src/css/normaliz-style-min.css">
	<link rel="stylesheet" href="./src/css/main.css">
	<link rel="stylesheet" href="./components/autor-resourse/autor-footer-style.css">
</head>

<body class="body">
	<?php
	session_start();
	require "./components/autoloadComponent.php";
	// $_SESSION['errmsg'] = '';
	?>

	<header class="container__wraper">
		<?php echo Header::render(); ?>
	</header>

	<main class="container__wraper">

		<?php
		if (!isset($_GET['page'])) {
			include('./components/pages/main.php');
		} else {
			$page = $_GET['page'];
			if (file_exists('./components/pages/' . $page . '.php')) {
				include('./components/pages/' . $page . '.php');
			} else {
				include('./components/pages/nocontent.php');
			}
		}
		?>


	</main>

	<!-- engine moduls -->
	<div class="eng_moduls" id="engModuls">
		<?php require_once('./engine/auth.php'); ?>
	</div>

	<footer class="container__wraper">
		<?php echo Footer::render(); ?>
		<div id="autor"></div>
	</footer>


	<script src="./src/js/mob-menu.js"></script>
	<script src="./src/js/login.js"></script>
	<script src="./components/autor-resourse/autor-footer-script.js"></script>
</body>

</html>