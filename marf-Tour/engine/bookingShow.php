<?php
include "./engine/mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);

if (isset($_GET['btn'])) {
	$roomId = $_GET['id'];
	$query = "SELECT * FROM `Bookings` WHERE room_id='$roomId'";
} else {
	$query = "SELECT * FROM `Bookings`";
}

$Bookings = $mysql->query($query);

echo '
<table>
	<caption>
		celkem - ' . $Bookings->num_rows . ' objednanih pokoje
	</caption>

	<thead class="table_head">
		<tr>
			<th scope="col">id</th>
			<th scope="col">room_id</th>
			<th scope="col">room_name</th>
			<th scope="col">start_date</th>
			<th scope="col">end_date</th>
			<th scope="col">nights</th>
			<th scope="col">user_id</th>
			<th scope="col">user_name</th>
		</tr>
	</thead>

	<tbody>
';

while ($resrv = $Bookings->fetch_assoc()) {
	echo '
	<tr>
		<th scope="row">' . $resrv['id'] . '</th>
		<td>' . $resrv['room_id'] . '</td>
		<td>' . $resrv['room_name'] . '</td>
		<td>' . $resrv['start_date'] . '</td>
		<td>' . $resrv['end_date'] . '</td>
		<td>' . $resrv['nights'] . '</td>
		<td>' . $resrv['user_id'] . '</td>
		<td>' . $resrv['user_name'] . '</td>
		
	</tr>
	';
}

?>

</tbody>
</table>