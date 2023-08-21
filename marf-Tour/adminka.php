<?php
session_start();
if ($_SESSION['userRole'] != 'admin') {
	header('Location: ./');
	session_destroy();
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adminka</title>
	<link rel="shortcut icon" href="./src/icons/ico-marf-bg.png" type="image/png">
	<link rel="stylesheet" href="./src/css/normaliz-style-min.css">
	<link rel="stylesheet" href="./src/css/adminka.css">
	<link rel="stylesheet" href="./components/autor-resourse/autor-footer-style.css">
</head>

<body>
	<?php require "./components/autoloadComponent.php"; ?>

	<header class="container__wraper">
		<div class="header__navbar_wraper">
			<div class="navbar_brand">
				<a href="./adminka.php">
					<span>marf-travel</span>
					<img src="./src/icons/ico-marf-bg.png" alt="">
				</a>
			</div>
		</div>
	</header>

	<main class="container__wraper">
		<div class="main__content_container">
			<div class="admin__aside">
				<ul class="admin_links">
					<li class="links_item"><a href="?query=roomShow">Pokoj</a></li>
					<li class="links_item"><a href="?query=addRoom">pridat novy</a></li>
					<li class="links_item"><a href="?query=userShow">Uzivatelu</a></li>
					<li class="links_item"><a href="?query=bookingShow">Reservace</a></li>
				</ul>
			</div>

			<div class="admin__content">

				<?php
				if (!isset($_GET['query'])) {
					include('./engine/roomShow.php');
				} else {
					$page = $_GET['query'];
					if (file_exists('./engine/' . $page . '.php')) {
						include('./engine/' . $page . '.php');
					} else {
						include('./components/pages/nocontent.php');
					}
				}

				?>

			</div>

		</div>

	</main>


	<footer class="container__wraper">
		<?php echo Footer::render(); ?>
		<div id="autor"></div>
	</footer>

	<script src="./components/autor-resourse/autor-footer-script.js"></script>
</body>

</html>