<?php
session_start();
$submit = $_SERVER['REQUEST_METHOD'];
include "./engine/mysqlConnect.php";
$linkdb = new mysqli($host, $name, $pass, $db);

if ($submit == 'POST') {
	$mail = $_POST['usermail'];
} elseif (isset($_SESSION['mail'])) {
	$mail = $_SESSION['mail'];
}

if ($mail) {
	$userData = $linkdb->query("SELECT * FROM `Users` WHERE email='$mail'");

	if ($userData->num_rows > 0) {
		$user = $userData->fetch_assoc();
		$userName = $user['username'];
	}
} elseif ($_SESSION['errors'] === true) {
	$errmsg = $_SESSION['errors'];
	$mail = $_SESSION['mail'];
	$userName = $_SESSION['userName'];

	$userData = $linkdb->query("SELECT * FROM `Users` WHERE email='$mail'");
	$user = $userData->fetch_assoc();
}

if (isset($userName)) {
	$loginTitle = '<h2>Ahoj ' . $userName . ' !<h2>
		<p>Tvuj mail - ' . $mail . '</p>
		<p>zadejte prosím své heslo -></p>';

	if ($user['role'] == 'admin') {
		$loginMsg = '<h3>Čeká na vás mnoho zakázek!</h3>';
	} else {
		$loginMsg = '<h3>Je čas vybrat si nejlepší místo k pobytu!</h3>';
	}

	$target = './engine/login.php';
	$loginInputs = '<input class="form_item" type="password" name="userPass" id="userPass" placeholder="zadejte vase heslo">';
} else {
	$loginTitle = '<h2>Prosím registrujte se!</h2>
		<p>Tvuj mail - ' . $mail . '</p>
		<p>zadejte prosím své jmeno a heslo -></p>';
	$loginMsg = '<h3>Je čas vybrat si nejlepší místo k pobytu!</h3>';
	$loginInputs = '
	<input class="form_item" type="text" name="userName" id="userName" placeholder="zadejte vase jmeno">
	<input class="form_item" type="password" name="userPass" id="userPass" placeholder="zadejte vase heslo">';
	$target = './engine/reg.php';
}

$_SESSION['mail'] = $mail;
?>

<div class="authorizacion__wraper">
	<div class="form__wraper">

		<form method="post" action="<?php echo $target; ?>">
			<div style="color: red;">
				<?php
				if (isset($_SESSION['errmsg'])) {
					echo $_SESSION['errmsg'];
					$_SESSION['errors'] = false;
					unset($_SESSION['errmsg']);
				}
				?>
			</div>

			<div class="form_conteiner">
				<?php
				echo $loginTitle . $loginMsg . $loginInputs;
				?>

				<button class="btn_submit" type="submit">vchod</button>
			</div>
		</form>
	</div>
</div>

<?php
$linkdb->close();
?>