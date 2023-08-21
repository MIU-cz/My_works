<?php
session_start();
include "./engine/mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);

if (isset($_SESSION['userId'])) {
	$usserId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
	$userMail = $_SESSION['mail'];

	$userMsg = '
		<div class="form_user">
			<p>Ahoj! ' . $userName . '</p>
			<p>zkontrolujte své údaje a klikněte &#8681;</p>
		</div>
	';
} else {
	$userMsg = '
		<input class="form_item" type="text" name="userName" id="userName" placeholder="zadejte vase jmeno" required>
		<input class="form_item" type="email" name="userMail" id="userMail" placeholder="zadejte vas e-mail" required>
	';
}

if (isset($_POST['roomId'])) {
	$roomId = $_POST['roomId'];
	$roomName = $_POST['roomName'];

	$roomMsg = '
		<h2>Vybrali jste pokoj #:' . $roomId . ' - ' . $roomName . '</h2>
		<p>skvělá volba! je čas si to zarezervovat &#8680;</p>
	';

	$_SESSION['roomId'] = $roomId;
	$_SESSION['roomName'] = $roomName;
} else {
	$roomMsg = 'zadejte reservace:';
}

if (isset($_SESSION['arrDate'])) {
	$arrDate = $_SESSION['arrDate'];
	$depDate = $_SESSION['depDate'];

	$dateMsg = '
		<p>chcete si zarezervovat pokoj od ' . $arrDate . ' do ' . $depDate . ' </p>
		<p>&#8680; uveďte datum rezervace: </p>
	';
} else {
	$dateMsg = '
		<p>&#8680; uveďte datum rezervace: </p>
	';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formReservace'])) {
	$arrDate = date('Y-m-d', strtotime($_POST['arrivalDate']));
	$depDate = date('Y-m-d', strtotime($_POST['departureDate']));
	$nights = $_POST['nightsCol'];
	$roomId = $_SESSION['roomId'];
	$roomName = $_SESSION['roomName'];
	$_SESSION['errmsg'] = '';

	if (isset($_POST['userName'])) {
		$userName = $_POST['userName'];
		$userMail = $_POST['userMail'];

		$userQuery = "SELECT * FROM `Users` WHERE email='$userMail'";
		$usser = $mysql->query($userQuery);

		if ($usser->num_rows > 0) {
			$errorMsg = '
			<p>takový účet již existuje!</p> 
			<p>musíte se přihlásit..</p> 
			';

			$_SESSION['mail'] = $userMail;
			$_SESSION['errmsg'] = $errorMsg;
			header("Location: ./?page=authChek");
			exit();
		} else {
			$userQuery = "INSERT INTO `Users` (username, email, password, role) 
			VALUES ('$userName', '$userMail', '', 'user')";
			$mysql->query($userQuery);

			$userQuery = "SELECT * FROM `Users` WHERE email='$userMail'";
			$usser = $mysql->query($userQuery)->fetch_assoc();
			$usserId = $usser['id'];
		}
	}

	$query = "SELECT * FROM `Bookings` WHERE room_id='$roomId' AND '$arrDate' < end_date AND '$depDate' > start_date";
	$noBook = $mysql->query($query);

	if ($noBook->num_rows > 0) {
		$errorMsg = '
			<p>po tuto dobu není číslo dostupné!</p> 
			<p>vybrat si jiné období..</p>
			';

		$_SESSION['errmsg'] = $errorMsg;
		header("Location: ./?page=addBooking#formReservace");
		exit();
	} else {
		$query = "INSERT INTO `Bookings` (room_id, room_name, start_date, end_date, nights, user_name, user_id) 
		VALUES ('$roomId', '$roomName', '$arrDate', '$depDate', '$nights', '$userName', '$usserId')";
	}

	if ($mysql->query($query)) {
		$roomMsg = '
			<div class="msgOk">
				<h3>rezervace byla úspěšná!</h3>
				<p>mezitím naši manažeři bojují o to, který z nich zpracuje vaši objednávku,</p>
				<p>můžete začít balit kufry</p>
			</div>
		';
	} else {
		$roomMsg = '
			<div class="msgErr">
				<p>něco je špatně ??</p>
				<p>zkus to znovu !!</p>
			</div>
		';
	}
}
if (isset($_SESSION['errmsg'])) {
	$errorMsg = $_SESSION['errmsg'];
} else {
	$errorMsg = '';
}

// print_r($_POST);
// echo '<br>============<br>';
// print_r($_SESSION);
?>

<div class="boking__wraper" id="formReservace">
	<div class="room__filter">
		<div class="filter_title">
			<?php echo $roomMsg; ?>
		</div>

		<div class="form_wraper">

			<form name="formReservace" method="post" id="formFilter" action="./?page=addBooking#formReservace">
				<input type="hidden" name="formReservace" value="true">
				<div class="form_msg">
					<?php echo $dateMsg ?>
				</div>

				<div class="form_date">
					<label>zadejte datum příjezdu:
						<input class="form_input" type="date" name="arrivalDate" id="arrivalDate" required>
					</label>
					<label>počet nocí:
						<input class="form_input" type="number" value="7" min="2" name="nightsCol" id="nightsCol">
					</label>
					<label>nebo zadejte datum odjezdu:
						<input class="form_input" type="date" name="departureDate" id="departureDate" required>
					</label>
				</div>

				<div class="errorForm" id="errorForm">
					<?php echo $errorMsg; ?>
				</div>

				<div class="form_user form_date">
					<?php echo $userMsg; ?>
				</div>

				<div class="form_btn">
					<button class="btn_submit" type="submit" id="btnSubmit">rezervovat</button>
				</div>

			</form>
		</div>
	</div>

</div>

<script src="./src/js/room-filtr.js"></script>