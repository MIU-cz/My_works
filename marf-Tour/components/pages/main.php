<?php
include "./engine/mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);
// $mysql->query("SET NAMES 'utf8'");
if ($mysql->connect_error) {
	echo 'Error: ' . $mysql->connect_errno . '<br>';
	echo 'Error: ' . $mysql->connect_error . '<br>';
	header("Location: index.php?page=nocontent");
	exit();
}

$creatSomeTable = function ($x) {
	for ($i = 0; $i < $x; $i++) {
		RoomCardStatic::setid($i + 1);
		echo RoomCardStatic::render();
	}
}
?>

<div class="main__content_container">
	<h1>nejlepší nabídky od nejlepšího operátora</h1>

	<div class="room__filter" id="roomForm">
		<h3 class="formHeader" id="formHeader" onclick="showFilter()">vybrat možnosti pokoje</h3>
		<div class="form_wraper hide">

			<form name="formFilter" method="post" id="formFilter" action="./?page=main#roomForm">
				<input type="hidden" name="formFilter" value="true">
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

				<div class="form_spec">
					<select name="rooms" class="item_roomcol">
						<option value="Jeden">Jeden</option>
						<option value="Dva">Dva</option>
						<option value="Tri">Tri</option>
						<option value="Studio">Studio</option>
						<option value="Luxus">Luxus</option>
					</select>
				</div>

				<div class="errorForm" id="errorForm"></div>

				<div class="form_btn">
					<button class="btn_submit" type="submit" id="btnSubmit">filtrovat</button>
				</div>

			</form>
		</div>
	</div>


	<?php
	$rooms = $mysql->query("SELECT * FROM `Rooms`");
	if ($rooms->num_rows > 0) {
		include('./engine/roomShow.php');
	} else {
		echo '<div class="content__grid">';
		$creatSomeTable(8);
		echo '</div>';
		$mysql->close();
	}

	?>


</div>

<script src="./src/js/room-filtr.js"></script>