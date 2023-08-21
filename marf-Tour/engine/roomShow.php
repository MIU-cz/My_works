<?php
session_start();
include "./engine/mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formFilter'])) {
	$arrDate = date('Y-m-d', strtotime($_POST['arrivalDate']));
	$depDate = date('Y-m-d', strtotime($_POST['departureDate']));
	$room = $_POST['rooms'];

	$query = "SELECT * FROM `Rooms` WHERE room='$room'
	AND id NOT IN (SELECT room_id FROM `Bookings` WHERE '$arrDate' < end_date AND '$depDate' > start_date)";

	$nextQuery = "SELECT * FROM `Rooms` WHERE room='$room'
	AND id NOT IN (SELECT room_id FROM `Bookings` WHERE '$arrDate' <= end_date - INTERVAL 3 DAY)";

	$nextTabRooms = $mysql->query($nextQuery);

	$_SESSION['arrDate'] = $arrDate;
	$_SESSION['depDate'] = $depDate;
} else {
	$query = "SELECT * FROM `Rooms`";
}

$tabRooms = $mysql->query($query);

$roomShow = function ($tabRooms, $mysql) {
	while ($row = $tabRooms->fetch_assoc()) {
		$roomCard = new RoomCard();
		$roomCard->setArr($row);

		$tabBook = $mysql->query("SELECT * FROM `Bookings` WHERE room_id='" . $row['id'] . "'");
		$sumBook = $tabBook->num_rows;

		$userBtn = '
		<form action="./?page=addBooking#formReservace" method="post">
		<input type="hidden" name="roomId" value="' . $row['id'] . '">
		<input type="hidden" name="roomName" value="' . $row['name'] . '">
		<button class="btn_booking" id="btnBooking" data-id="' . $row['id'] . '">chci to</button>
		</form>
		';

		$adminBtn = '<div class="card_btn">
		<a class="btn btn_booking_copy" data-id="' . $row['id'] . '" href="./engine/adminBtns.php?btn=copy&id=' . $row['id'] . '">copy</a>
		<a class="btn btn_booking_dell" data-id="' . $row['id'] . '" href="./engine/adminBtns.php?btn=dell&id=' . $row['id'] . '">delete</a>
		<p class="btn btn_txt"> Booking: ' . $sumBook . '</p>
		<a class="btn btn_booking" data-id="' . $row['id'] . '" href="?query=bookingShow&btn=booking&id=' . $row['id'] . '">view bookings</a>
		</div> ';

		$curUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$roomBtn = $adminBtn;

		if (strpos($curUrl, 'adminka.php') === false) {
			$roomBtn = $userBtn;
		}

		$cardRender = '<div class="card_wraper">'
			. $roomCard->render()
			. $roomBtn
			. '</div>';

		echo $cardRender;
	}
};

echo '<h2>vsehno mate: ' . $tabRooms->num_rows . ' pokoje </h2>';
echo '<div class="content__grid">';

if ($tabRooms->num_rows == 0) {
	echo '<h2>tady nic není<h2>';
} else {
	$roomShow($tabRooms, $mysql);
}

echo '</div>';

if (isset($nextTabRooms) && $nextTabRooms->num_rows > 0) {
	echo '<div class="nextRooms">
	<h3 >ale vsechny tyto pokoje budou volné během několika příštích dní od předpokládaného data vaší rezervace &#8680;&#8680;</h3>
	</div>
	<div class="content__grid">';
	$roomShow($nextTabRooms, $mysql);
	echo '</div>';
}

// if (isset($row['id'])) {
// 	$_SESSION['roomId'] = $row['id'];
// }

$mysql->close();
?>

<script src="./src/js/room-view-img.js"></script>