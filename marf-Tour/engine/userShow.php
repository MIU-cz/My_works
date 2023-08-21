<?php
include "./engine/mysqlConnect.php";
$mysql = new mysqli($host, $name, $pass, $db);
$users = $mysql->query("SELECT * FROM `Users`");

echo '
<table>
	<caption>
		celkem - ' . $users->num_rows . ' uživatelů ve společnosti MARF-Travel
	</caption>

	<thead class="table_head">
		<tr>
			<th scope="col">id</th>
			<th scope="col">Name</th>
			<th scope="col">e-Mail</th>
			<th scope="col">role</th>
			<th scope="col">cislo obj</th>
		</tr>
	</thead>

	<tbody>
';

while ($user = $users->fetch_assoc()) {
	$userBoking = $mysql->query("SELECT * FROM `Bookings` WHERE user_id='" . $user['id'] . "'");
	$sumBokings = $userBoking->num_rows;

	echo '
	<tr>
		<th scope="row">' . $user['role'] . '</th>
		<td>' . $user['id'] . '</td>
		<td>' . $user['username'] . '</td>
		<td>' . $user['email'] . '</td>
		<td>' . $sumBokings . '</td>
	</tr>
	';
}

?>

</tbody>
</table>